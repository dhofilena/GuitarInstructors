<?php


/**
 * Handle the callback
 */
function webcretix_social_login_callback () {
	if($_COOKIE["fbe"] != "" and $_COOKIE["fbtoken"] != ""){
		
		$email = $_COOKIE["fbe"];
		$password = $_COOKIE["fbtoken"];
		$fbfn= $_COOKIE["fbfn"];
		$fbln= $_COOKIE["fbln"];
		
		if(!email_exists( $email )) {
			$userdata = array( 
			  'user_login'    =>   $email,    
			  'user_email'    =>   $email,
			  'user_pass'     =>   $password,
			  'user_nicename' =>   $fbfn. "-" .$fbln,
			  'display_name' =>  $fbfn. " " .$fbln
			);
			$user = wp_insert_user( $userdata );					  
			if( is_wp_error( $user ) ) {
			  echo $user->get_error_message();
			}else{		
			  echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';  
			}
   		}
		
		if(!$_REQUEST["action"] == "logout"){
			$user = get_user_by( 'email', $email );
			$id = $user->id;
			wp_set_current_user( $id );
			wp_set_auth_cookie( $id );		
			do_action("wp_login", $user->user_login);	
		}
	}
}

function webcretix_social_login_logout () {
	echo "
	<script>
	window.fbAsyncInit = function() {
		FB.init({
	  		appId      : '427258067427726',
	  		xfbml      : true,
	  		version    : 'v2.2'
		});
		
		FB.getLoginStatus(function(response) {
	  		FB.logout();
		});
		
		
  	};

    (function(d, s, id) {
    	var js, fjs = d.getElementsByTagName(s)[0];
    	if (d.getElementById(id)) return;
    	js = d.createElement(s); js.id = id;
    	js.src = \"//connect.facebook.net/en_US/sdk.js\";
    	fjs.parentNode.insertBefore(js, fjs);
  	}(document, 'script', 'facebook-jssdk'));

	
	
	</script>";
	
	unset($_COOKIE['fbe']);
	unset($_COOKIE['fbtoken']);
	unset($_COOKIE['fbfn']);
	unset($_COOKIE['fbln']);
	
	setcookie('fbe', "", time()-3600);
    setcookie('fbtoken', "", time()-3600 );
	setcookie('fbfn', "", time()-3600);
	setcookie('fbln', "", time()-3600);

}


/**
 * Send an API request by using the given handler
 */
function oa_social_login_do_api_request ($handler, $url, $options = array (), $timeout = 25)
{
	//FSOCKOPEN
	if ($handler == 'fsockopen')
	{
		return oa_social_login_fsockopen_request ($url, $options, $timeout);
	}
	//CURL
	else
	{
		return oa_social_login_curl_request ($url, $options, $timeout);
	}
}

/**
 * **************************************************************************************************************
 * ************************************************* FSOCKOPEN **************************************************
 * **************************************************************************************************************
 */

/**
 * Check if fsockopen is available.
 */
function oa_social_login_check_fsockopen_available ()
{
	//Make sure fsockopen has been loaded
	if (function_exists ('fsockopen') AND function_exists ('fwrite'))
	{
		$disabled_functions = oa_social_login_get_disabled_functions ();

		//Make sure fsockopen has not been disabled
		if (!in_array ('fsockopen', $disabled_functions) AND !in_array ('fwrite', $disabled_functions))
		{
			//Loaded and enabled
			return true;
		}
	}

	//Not loaded or disabled
	return false;
}


/**
 * Check if fsockopen is enabled and can be used to connect to OneAll.
 */
function oa_social_login_check_fsockopen ($secure = true)
{
	if (oa_social_login_check_fsockopen_available ())
	{
		$result = oa_social_login_fsockopen_request (($secure ? 'https' : 'http') . '://www.oneall.com/ping.html');
		if (is_object ($result) AND property_exists ($result, 'http_code') AND $result->http_code == 200)
		{
			if (property_exists ($result, 'http_data'))
			{
				if (strtolower ($result->http_data) == 'ok')
				{
					return true;
				}
			}
		}
	}
	return false;
}


/**
 * Send an fsockopen request.
 */
function oa_social_login_fsockopen_request ($url, $options = array (), $timeout = 15)
{
	//Store the result
	$result = new stdClass ();

	//Make sure that this is a valid URL
	if (($uri = parse_url ($url)) == false)
	{
		$result->http_code = -1;
		$result->http_data = null;
		$result->http_error = 'invalid_uri';
		return $result;
	}

	//Make sure that we can handle the scheme
	switch ($uri ['scheme'])
	{
		case 'http':
			$port = (isset ($uri ['port']) ? $uri ['port'] : 80);
			$host = ($uri ['host'] . ($port != 80 ? ':' . $port : ''));
			$fp = @fsockopen ($uri ['host'], $port, $errno, $errstr, $timeout);
			break;

		case 'https':
			$port = (isset ($uri ['port']) ? $uri ['port'] : 443);
			$host = ($uri ['host'] . ($port != 443 ? ':' . $port : ''));
			$fp = @fsockopen ('ssl://' . $uri ['host'], $port, $errno, $errstr, $timeout);
			break;

		default:
			$result->http_code = -1;
			$result->http_data = null;
			$result->http_error = 'invalid_schema';
			return $result;
			break;
	}

	//Make sure that the socket has been opened properly
	if (!$fp)
	{
		$result->http_code = -$errno;
		$result->http_data = null;
		$result->http_error = trim ($errstr);
		return $result;
	}

	//Construct the path to act on
	$path = (isset ($uri ['path']) ? $uri ['path'] : '/');
	if (isset ($uri ['query']))
	{
		$path .= '?' . $uri ['query'];
	}

	//Create HTTP request
	$defaults = array (
		'Host' => "Host: $host",
		'User-Agent' => 'User-Agent: SocialLogin ' . OA_SOCIAL_LOGIN_VERSION . 'WP (+http://www.oneall.com/)'
	);

	//Enable basic authentication
	if (isset ($options ['api_key']) AND isset ($options ['api_secret']))
	{
		$defaults ['Authorization'] = 'Authorization: Basic ' . base64_encode ($options ['api_key'] . ":" . $options ['api_secret']);
	}

	//Build and send request
	$request = 'GET ' . $path . " HTTP/1.0\r\n";
	$request .= implode ("\r\n", $defaults);
	$request .= "\r\n\r\n";
	fwrite ($fp, $request);

	//Fetch response
	$response = '';
	while (!feof ($fp))
	{
		$response .= fread ($fp, 1024);
	}

	//Close connection
	fclose ($fp);

	//Parse response
	list($response_header, $response_body) = explode ("\r\n\r\n", $response, 2);

	//Parse header
	$response_header = preg_split ("/\r\n|\n|\r/", $response_header);
	list($header_protocol, $header_code, $header_status_message) = explode (' ', trim (array_shift ($response_header)), 3);

	//Build result
	$result->http_code = $header_code;
	$result->http_data = $response_body;

	//Done
	return $result;
}

/**
 * **************************************************************************************************************
 ** *************************************************** CURL ****************************************************
 * **************************************************************************************************************
 */

/**
 * Check if cURL has been loaded and is enabled.
 */
function oa_social_login_check_curl_available ()
{
	//Make sure cURL has been loaded
	if (in_array ('curl', get_loaded_extensions ()) AND function_exists ('curl_init') AND function_exists ('curl_exec'))
	{
		$disabled_functions = oa_social_login_get_disabled_functions ();

		//Make sure cURL not been disabled
		if (!in_array ('curl_init', $disabled_functions) AND !in_array ('curl_exec', $disabled_functions))
		{
			//Loaded and enabled
			return true;
		}
	}

	//Not loaded or disabled
	return false;
}


/**
 * Check if CURL is available and can be used to connect to OneAll
 */
function oa_social_login_check_curl ($secure = true)
{
	if (oa_social_login_check_curl_available ())
	{
		$result = oa_social_login_curl_request (($secure ? 'https' : 'http') . '://www.oneall.com/ping.html');
		if (is_object ($result) AND property_exists ($result, 'http_code') AND $result->http_code == 200)
		{
			if (property_exists ($result, 'http_data'))
			{
				if (strtolower ($result->http_data) == 'ok')
				{
					return true;
				}
			}
		}
	}
	return false;
}


/**
 * Send a CURL request.
 */
function oa_social_login_curl_request ($url, $options = array (), $timeout = 15)
{
	//Store the result
	$result = new stdClass ();

	//Send request
	$curl = curl_init ();
	curl_setopt ($curl, CURLOPT_URL, $url);
	curl_setopt ($curl, CURLOPT_HEADER, 0);
	curl_setopt ($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt ($curl, CURLOPT_VERBOSE, 0);
	curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt ($curl, CURLOPT_USERAGENT, 'SocialLogin ' . OA_SOCIAL_LOGIN_VERSION . 'WP (+http://www.oneall.com/)');

	// BASIC AUTH?
	if (isset ($options ['api_key']) AND isset ($options ['api_secret']))
	{
		curl_setopt ($curl, CURLOPT_USERPWD, $options ['api_key'] . ":" . $options ['api_secret']);
	}

	//Make request
	if (($http_data = curl_exec ($curl)) !== false)
	{
		$result->http_code = curl_getinfo ($curl, CURLINFO_HTTP_CODE);
		$result->http_data = $http_data;
		$result->http_error = null;
	}
	else
	{
		$result->http_code = -1;
		$result->http_data = null;
		$result->http_error = curl_error ($curl);
	}

	//Done
	return $result;
}