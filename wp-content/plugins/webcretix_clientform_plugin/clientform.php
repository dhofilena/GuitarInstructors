<?php
/*
  Plugin Name: Webcretix Client Registration/Login Plugin
  Description: Plugin Registers or gives access to users.
  Version: 1.0
  Author: Dominic Hofilena
*/

function registration_form($password, $email) {
  echo '<style>
	  div {
		  margin-bottom:2px;
	  }
   
	  input{
		  margin-bottom:4px;
	  }
  </style>';
  
  echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">\
  
  	  <div>
		  <label for="email">Email <strong>*</strong></label>
		  <input type="text" name="email" value="' . ( isset( $_POST['email']) ? $email : null ) . '">
	  </div> 
  		   
	  <div>
		  <label for="password">Password <strong>*</strong></label>
		  <input type="password" name="password" value="' . ( isset( $_POST['password'] ) ? $password : null ) . '">
	  </div>	          	 
	  
	  <input type="submit" name="submit" value="Register"/>
  </form>';
}

function registration_validation($password, $email) {
	
	global $reg_errors;
	$reg_errors = new WP_Error;
	
	/*Create rules*/
	if (empty( $password ) || empty( $email )) 
    	$reg_errors->add('field', 'Required form field is missing');
		
	if (username_exists($username))
    	$reg_errors->add('user_name', 'Sorry, that username already exists!');
		
	if (!validate_username($username)) 
    	$reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
		
	if (5 > strlen($password)) 
        $reg_errors->add( 'password', 'Password length must be greater than 5' );
		
	if (!is_email($email)) 
    	$reg_errors->add( 'email_invalid', 'Email is not valid' );
		
	if (email_exists($email)) 
    	$reg_errors->add( 'email', 'Email Already in use' ); 
	 
	if ( is_wp_error( $reg_errors ) ) {
    	foreach ( $reg_errors->get_error_messages() as $error ) {     
        	echo '<div>';
        	echo '<strong>ERROR</strong>:';
        	echo $error . '<br/>';
        	echo '</div>';         
    	} 
	}
}

function complete_registration() {
    global $reg_errors, $password, $email;
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array( 
			'user_login'    =>   $email,    
        	'user_email'    =>   $email,
        	'user_pass'     =>   $password
        );
        $user = wp_insert_user( $userdata );
		
		if( is_wp_error( $user ) ) {
    		echo $user->get_error_message();
		}else{		
        	echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';  
		}
    }
}



function webcretix_clientform_main() {
    if ( isset($_POST['submit'] ) ) {
        registration_validation(
        	$_POST['password'],
        	$_POST['email']       
        );
         
        // sanitize user form input
        global $password, $email;
      
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );       
 
        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
        	$password,
        	$email
        );
    }
 
    registration_form($password,$email);
}



function webcretix_login_form() { 
?>
 
 
 <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>" class="gi-form">
 	<label>Username:</label><input type="text" name="gi-un" />
 	<div class="clear" style="height:5px;"></div>
 	<label>Password:</label><input type="password" name="gi-pw" />
    <input type="submit" name="submit" value="Log in" />
 </form>
<?php
}

function webcretix_login_auth( $username, $password ) {
	global $user;
	$creds = array();
	$creds['user_login'] = $username;	
	$creds['user_password'] =  $password;
	$creds['remember'] = true;
	
	$user = wp_signon($creds, false );
	if ( is_wp_error($user) ) {
		echo '<p class="err-msg" >'.$user->get_error_message().'</p>';
	}
	if ( !is_wp_error($user) ) {
		wp_redirect(home_url('wp-admin'));
	}
}


function webcretix_login_main(){

	if(isset($_POST["gi-un"])){
		webcretix_login_auth($_POST["gi-un"], $_POST["gi-pw"]);
	}
	webcretix_login_form();
}




// Register a new shortcode: [cr_custom_registration]
add_shortcode( 'webcretix_login', 'webcretix_login_shortcode' );
 
// The callback function that will replace [book]
function webcretix_login_shortcode() {
    ob_start();
    webcretix_login_main();
    return ob_get_clean();
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode( 'webcretix_clientform', 'webcretix_clientform_shortcode' );
 
// The callback function that will replace [book]
function webcretix_clientform_shortcode() {
    ob_start();
    webcretix_clientform_function();
    return ob_get_clean();
}