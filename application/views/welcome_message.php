
    <div id="main" role="main">
			<h1>Facebook stuff</h1>

			    <?php if (@$user_profile): ?>
			        <pre>
			            <?php echo print_r($user_profile, TRUE) ?>
			        </pre>
			        <a href="<?php echo $logout_url ?>">Logout of this thing</a>
			    <?php else: ?>
			        <h2>Welcome to this facebook thing, please login below</h2>
			        <a href="<?php echo $login_url ?>">Login to this thing</a>
			    <?php endif; ?>
		<section id="mainSection">
			<div id="fb-root"></div>
			<script src="https://connect.facebook.net/en_US/all.js#appId=311371812294772&xfbml=1"></script>
			<script type="text/javascript" charset="utf-8">
			window.fbAsyncInit = function() {
			  FB.init({appId: '311371812294772', status: false, cookie: true, xfbml: true});
			  //Check if user is logged-in to facebook:
			  FB.getLoginStatus(function(response) {
				  if (response.status === 'connected') {
				
					// this line is to hide the login button
					//$('.fb_iframe_widget').hide();
					alert(response.authResponse.userID+' he/she is a fb user');
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
					alert('not logged in to FB');
				    // the user isn't logged in to Facebook.
				  }
				 });
				FB.Event.subscribe('auth.login', function(r)
				    {
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
    
