<?php

/**
*
* Plugin Name: Enclothed Profile
* Provides: enc_profile
* Description: A custom built plugin to intake and process specific user profile forms
* Author: Like Digital Media
* Author URI: http://likedigitalmedia.com
* Version: 0.1
* Depends: enc_main
* Provides: enc_profile
*
**/


require_once(dirname(plugin_dir_path(__FILE__)) . "/enclothed-main/enclothed-main.php");


add_action('init', 'enc_profile_init');
function enc_profile_init(){
	$enclothed = new EnclothedProfile();
	$enclothed->process_my_forms();
}

// add_action( 'init', array('EnclothedProfile', 'process_my_form' ));

class EnclothedProfile {

	public $main; //main class

	public function __construct(){
		$this->main = new EnclothedMain(); 
	}


	//This will process every single form for the user extended profile.
	//it will also check the nonce from the form to make sure it comes from the right place
	public function process_my_forms() {
		if (!empty($_POST['nonce'])){

			//we will call each method based on 
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/address/' ) ) {
				$this->process_address_form();
			}	
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/sizing/' ) ) {
				$this->process_sizing_form();
			}
		}
	}


	public function process_address_form(){
		// setFlashMessage('error', 'this is an error message');
		// setFlashMessage('success', 'this is a success message');

		if (isset($_POST['section_1'])){
			//a more convenient variable
			$section = $_POST['section_1']; 
		}

		//validation
		$errors = array();
		//no name
		if (empty($section['name'])) {
			$str = 'Please enter a name.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		}
		//no email
		if (empty($section['email'])){
			$str = 'Please enter an email.';
			$errors[] = $str; 
			setFlashMessage('error', $str);	
		}

		//check that its a valid email address
		preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $section['email'], $match); 

		if (empty($match[0])){
			$str = 'Please enter a valid email.';
			$errors[] = $str; 
			setFlashMessage('error', $str);		
		}
		
		//no dob
		if (empty($section['dob'])) {
			$str = 'Please enter your date of birth.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		}

		//no password
		if (empty($section['password'])) {
			$str = 'Please enter a password.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		}else if (count($section['password']) < 6) {
			$str = 'Password needs to be at least 6 characters.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		}

		//feedback 'other' and no text on other


		//sanitization before db

		//go back to the page if validation failed
		if (!empty($errors)){
			//clear the session just in case something was wrong this time.
			unset($_SESSION['section_1']); 
			return; 
		} else {
			//if all went well then just remember the answers in the session
			//$this->save();
			wp_redirect( home_url().'/profile/sizing' ); 
			exit;	
		}
		
	}


	public function process_sizing_form(){
		$data = 'this is the data';
		global $current_user;
		$this->main->sendmail($current_user->data->user_email, 'Thank you!', Emails_model::TEMPLATE_THANK_YOU, $data);
		wp_redirect( home_url().'/profile/style' ); 
		exit;
	}


} //end of class

