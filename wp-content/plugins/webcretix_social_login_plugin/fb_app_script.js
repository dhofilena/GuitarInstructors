window.fbAsyncInit = function() {
  FB.init({
    "appId":'427258067427726',
    "xfbml":true,
    "version":'v2.2',
    "oauth":true,
	"channelUrl": document.location.protocol + '//localhost/GuitarInstructors/wp-content/plugins/webcretix_social_login_plugin/fbchannel.html'
  });
    
  FB.getLoginStatus(function(response) {
	statusChangeCallback(response);
  }); 
  
};

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

    
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
	  document.cookie="fbtoken="+response.authResponse.accessToken;
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  } 
  
  /* Function to call the FB login page */
  function FB_Login_popup(){
  	FB.login(function(response){
		if (response.status === 'connected') {
		  getUser();
		} else if (response.status === 'not_authorized') {
		  // The person is logged into Facebook, but not your app.
		} else {
		  // The person is not logged into Facebook, so we're not sure if
		  // they are logged into this app or not.
		}
	});
  }
  
  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function getUser() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
	  
	  document.cookie="fbe="+response.email;
	  document.cookie="fbfn="+response.first_name;
	  document.cookie="fbln="+response.last_name;
	  
	  location.reload();
    });
  }
