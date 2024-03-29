<?php
/** 
 * Template Name: Login Template
 */ 
get_header();
?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Log In</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Log In</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
	<div class="row">
		<div class="col-xl-5 offset-xl-3">


			<div class="login-register-page">
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>We're glad to see you again!</h3>
					<span>Don't have an account? <a href="<?php echo home_url('register');?>">Sign Up!</a></span>
					<?php if(!empty($error = my_check_login())) {
						if(count($error)){
							echo $error['invalid_user'];
						}
					}?>
				</div>
					
				<!-- Form -->
				<form method="post" action="" id="login-form">
					<div class="input-with-icon-left">
						<i class="icon-material-baseline-mail-outline"></i>
						<input type="text" class="input-text with-border" name="user_login" id="user_login"  placeholder="Email Address" required/>
					</div>

					<div class="input-with-icon-left">
						<i class="icon-material-outline-lock"></i>
						<input type="password" class="input-text with-border" name="user_password" id="user_password" placeholder="Password" required/>
					</div>
					<!-- <a href="#" class="forgot-password">Forgot Password?</a> -->
				</form>
				
				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form" id="login_Sbumit" name="login_Sbumit">Log In <i class="icon-material-outline-arrow-right-alt"></i></button>
				
				<!-- Social Login -->
				<!-- <div class="social-login-separator"><span>or</span></div>
				<div class="social-login-buttons">
					<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Log In via Facebook</button>
					<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Log In via Google+</button>
				</div> -->
			</div> 

		</div>
	</div>
</div>


<!-- Spacer -->
<div class="margin-top-70"></div>
<!-- Spacer / End-->
<?php
get_footer();