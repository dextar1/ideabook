
    <div id="main" role="main">
		<section id="mainSection">
			<div id="fb-root"></div>
			<script src="https://connect.facebook.net/en_US/all.js#appId=311371812294772&xfbml=1"></script>
			<script type="text/javascript" charset="utf-8">
			window.fbAsyncInit = function() {
			  //FB.init({appId: '311371812294772', status: true, cookie: true, xfbml: true});
			  //Check if user is logged-in to facebook:
			  FB.getLoginStatus(function(response) {
				  if (response.status === 'connected') {
				
					// this line is to hide the login button
					$('.fb_iframe_widget').hide();
					alert(response.authResponse.userID);
				    // the user is logged in and has authenticated your
				    // app, and response.authResponse supplies
				    // the user's ID, a valid access token, a signed
				    // request, and the time the access token 
				    // and signed request each expire
				    var uid = response.authResponse.userID;
				    var accessToken = response.authResponse.accessToken;
				  } else if (response.status === 'not_authorized') {
					alert('got it yes');
				    // the user is logged in to Facebook, 
				    // but has not authenticated your app
				  } else {
					alert('got it not');
				    // the user isn't logged in to Facebook.
				  }
				 });
				FB.Event.subscribe('auth.login', function(r)
				    {
				        console.log(r.status);

				        if ( r.status === 'connected' )
				        {
				            // a user has logged in
										$('.fb_iframe_widget').hide();
										alert(r.authResponse.userID);
				        }
				    }
				);	
			};
			
							</script>
			<fb:login-button
			registration-url="http://127.0.0.1:8080/ideabook/index.php/welcome/action/register"
			 />
		</section>
    </div>
    
