    <div id="main" role="main">
			<h1>You are one step short to the whole World of Ideas</h1>
		<section id="mainSection">
			<div id="fb-root"></div>
			<script src="https://connect.facebook.net/en_US/all.js#appId=311371812294772&xfbml=1"></script>
			<script type="text/javascript" charset="utf-8">
			window.fbAsyncInit = function() {
			  FB.init({appId: '311371812294772', status: false, cookie: true, xfbml: true});
			  //Check if user is logged-in to facebook:
			  FB.getLoginStatus(function(response) {
				  if (response.status === 'connected') {
				$('.fb_iframe_widget ').hide();
				
					// this line is to hide the login button
					//$('.fb_iframe_widget').hide();
					//alert(response.authResponse.userID+' he/she is a fb user');
				    // the user is logged in and has authenticated your
				    // app, and response.authResponse supplies
				    // the user's ID, a valid access token, a signed
				    // request, and the time the access token 
				    // and signed request each expire
				    var uid = response.authResponse.userID;
				    var accessToken = response.authResponse.accessToken;
				  } else if (response.status === 'not_authorized') {
					alert('Logged in but not authorized User');
				    // the user is logged in to Facebook, 
				    // but has not authenticated your app
				  } else {
				    // the user isn't logged in to Facebook.
				  }
				 });
				FB.Event.subscribe('auth.login', function(r)
				    {
					$('.fb_iframe_widget ').hide();
				     	window.location.reload();  
				    }
				);	
			};
			
							</script>
			<fb:login-button
			registration-url="<?php echo $completeURL;?>"
			 />
			
		</section>
    </div>
    
