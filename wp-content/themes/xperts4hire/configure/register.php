<?php

add_action('template_redirect', 'my_check_login');
function my_check_login(){
    $errors = [];
    if( is_page('login') && isset($_POST['login_Sbumit']) ){
    // check input and
    // do my login stuff here 
    $creds                  = array();
	$creds['user_login']    = stripslashes( trim( $_POST['user_login'] ) );
	$creds['user_password'] = stripslashes( trim( $_POST['user_password'] ) );
	//$creds['remember']      = isset( $_POST['rememberMe'] ) ? sanitize_text_field( $_POST['rememberMe'] ) : '';
	$redirect_to            =  '';//esc_url_raw( $_POST['redirect_to'] );
	$secure_cookie          = null;
		
	if($redirect_to == '')
		$redirect_to= get_site_url(). '/dashboard/' ; 
		
		if ( ! force_ssl_admin() ) {
			$user = is_email( $creds['user_login'] ) ? get_user_by( 'email', $creds['user_login'] ) : get_user_by( 'login', sanitize_user( $creds['user_login'] ) );

		if ( $user && get_user_option( 'use_ssl', $user->ID ) ) {
			$secure_cookie = true;
			force_ssl_admin( true );
		}
	}

	if ( force_ssl_admin() ) {
		$secure_cookie = true;
	}

	if ( is_null( $secure_cookie ) && force_ssl_admin() ) {
		$secure_cookie = false;
	}

	$user = wp_signon( $creds, $secure_cookie );

	if ( $secure_cookie && strstr( $redirect_to, 'wp-admin' ) ) {
		$redirect_to = str_replace( 'http:', 'https:', $redirect_to );
	}

	if ( ! is_wp_error( $user ) ) {
		wp_safe_redirect( $redirect_to );			
	} else {			
		if ( $user->errors ) {
			$errors['invalid_user'] = __('<strong class="error">ERROR</strong>: Invalid user or password.'); 
		} else {
			$errors['invalid_user_credentials'] = __( 'Please enter your username and password to login.', 'kvcodes' );
		}
	}		   
	}
	return $errors;
}

//restrict login user to login page
function redirect_login_page() {

    if( is_page( 'login' ) && is_user_logged_in() ) {
        wp_redirect( home_url() );
        exit;
    }

}
add_action( 'template_redirect', 'redirect_login_page' );

add_action('template_redirect', 'my_check_register');
function my_check_register(){
    if( is_page('register') && isset($_POST['login_Register']) ){
		$username= sanitize_user($_POST['user_name']);
		$email= sanitize_email($_POST['user_email']);
	
		$error=array();
	
		if(strpos($username,' ')!==FALSE){
		  $error['username_space']= __('<strong class="error">ERROR</strong>: Username has space!');
	
		}
	
		if(empty($username)){
			$error['username_empty']= __('<strong class="error">ERROR</strong>: Username required!');
		}
		if(username_exists($username)){
		$error['username_exist']= __('<strong class="error">ERROR</strong>: Username already exist!');
	
		}
	
	 if(!is_email($email)){
		 $error['email_valid']= __('<strong class="error">ERROR</strong>: Enter Valid Email Address.');
	
		}
	
		if(email_exists($email)){
		 $error['email_existence']= __('<strong class="error">ERROR</strong>: Email exist!');
	
		}
	
		if(count($error)==0) {
		 $user_id = wp_create_user($username,$password,$email);
		 echo "you have registered succesfully.. ";
	
	   wp_new_user_notification($user_id);
	   exit();
		}
	
		else{
		   print_r($error);
		   }
	}

}

add_action( 'wp_ajax_nopriv_freelance_register', 'freelance_register' );
add_action( 'wp_ajax_freelance_register', 'freelance_register' );
function freelance_register(){
    if(isset($_POST['register']) ){
		$username= sanitize_user($_POST['username']);
		$email= sanitize_email($_POST['email']);
		$error=array();
		$user_id = wp_create_user( $username, $random_password, $email );
        $user_id_role = new WP_User($user_id);
		$user_id_role->set_role('employee');
		wp_new_user_notification($user_id);
	
			echo 'success';
	
	   die();
	}

}

function wc_registration_redirect( $redirect_to ) {
	wp_logout();
	wp_redirect( '/sign-in/?q=');
	exit;
}
// when user login, we will check whether this guy email is verify
function wp_authenticate_user( $userdata ) {
	$isActivated = get_user_meta($userdata->ID, 'is_activated', true);
	if ( !$isActivated ) {
		$userdata = new WP_Error(
			'inkfool_confirmation_error',
			__( '<strong>ERROR:</strong> Your account has to be activated before you can login. You can resend by clicking <a href="/sign-in/?u='.$userdata->ID.'">here</a>', 'inkfool' )
		);
	}
	return $userdata;
}
// when a user register we need to send them an email to verify their account
function my_user_register($user_id) {
		// get user data
		$user_info = get_userdata($user_id);
		// create md5 code to verify later
		$code = md5(time());
		// make it into a code to send it to user via email
		$string = array('id'=>$user_id, 'code'=>$code);
		// create the activation code and activation status
		update_user_meta($user_id, 'is_activated', 0);
		update_user_meta($user_id, 'activationcode', $code);
		// create the url
		$url = get_site_url(). '/sign-in/?p=' .base64_encode( serialize($string));
		// basically we will edit here to make this nicer
		$html = 'Please click the following links <br/><br/> <a href="'.$url.'">'.$url.'</a>';
		// send an email out to user
		wc_mail($user_info->user_email, __('Please activate your account'), $html);
}
// we need this to handle all the getty hacks i made
function my_init(){
		// check whether we get the activation message
		if(isset($_GET['p'])){
			$data = unserialize(base64_decode($_GET['p']));
			$code = get_user_meta($data['id'], 'activationcode', true);
			// check whether the code given is the same as ours
			if($code == $data['code']){
				// update the db on the activation process
				update_user_meta($data['id'], 'is_activated', 1);
				wc_add_notice( __( '<strong>Success:</strong> Your account has been activated! ', 'inkfool' )  );
			}else{
				wc_add_notice( __( '<strong>Error:</strong> Activation fails, please contact our administrator. ', 'inkfool' )  );
			}
		}
		if(isset($_GET['q'])){
			wc_add_notice( __( '<strong>Error:</strong> Your account has to be activated before you can login. Please check your email.', 'inkfool' ) );
		}
		if(isset($_GET['u'])){
			my_user_register($_GET['u']);
			wc_add_notice( __( '<strong>Succes:</strong> Your activation email has been resend. Please check your email.', 'inkfool' ) );
		}
}
// hooks handler
add_action( 'init', 'my_init' );
add_filter('woocommerce_registration_redirect', 'wc_registration_redirect');
add_filter('wp_authenticate_user', 'wp_authenticate_user',10,2);
add_action('user_register', 'my_user_register',10,2);
