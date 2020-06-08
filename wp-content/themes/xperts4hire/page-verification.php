<?php
/** 
 * Template Name: Verification Template
 */ 
get_header();
?>

<!-- Titlebar
================================================== -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>Verfication Status</h2>

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
					<!-- <h3>We're glad to see you again!</h3> -->
                    <?php echo do_shortcode('[user_verification_check]');?>
                    <span><a href="<?php echo home_url('login');?>">Login</a> to your account?</span>

				</div>
					
			</div> 

		</div>
	</div>
</div>



<!-- Spacer -->
<div class="margin-top-70"></div>
<!-- Spacer / End-->
<?php
get_footer();