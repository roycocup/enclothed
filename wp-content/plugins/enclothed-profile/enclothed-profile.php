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
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/details/' ) ) {
				$this->process_details_form();
			}	
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/sizing/' ) ) {
				$this->process_sizing_form();
			}
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/style/' ) ) {
				$this->process_style_form();
			}
		}
	}


	public function process_details_form(){

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

		//dob is not right format
		if (!empty($section['dob'])){
			preg_match('/^(0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])[\/\-]\d{4}$/', $section['dob'], $match);
			if (empty($match[0])){
				$str = 'Please insert a birth date using dd-mm-yyyy format.';
				$errors[] = $str; 
				setFlashMessage('error', $str);
			}
		}
		
		//no phone number
		if (empty($section['phone'])){
			$str = 'Please give us a phone number.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		} else if (!empty($section['phone'])) {
			if(strlen($section['phone'] < 8)){
				$str = 'Please give us a valid phone number.';
				$errors[] = $str; 
				setFlashMessage('error', $str);		
			}
		}

		//no address
		if (empty($section['address'])){
			$str = 'Please enter an address.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		}

		//no post code
		if (empty($section['post_code'])){
			$str = 'Please enter a post code.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		}		
		
		//no password
		if (empty($section['password'])) {
			$str = 'Please enter a password.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		}else if (strlen($section['password']) < 6) {
			$str = 'Password needs to be at least 6 characters.';
			$errors[] = $str; 
			setFlashMessage('error', $str);
		}

		//feedback 'other' and no text on other (not required)
		if (!empty($section['feedback_1']) && $section['feedback_1'] == 'other') {
			if (empty($section['feedback_2'])) {
				$str = 'Please tell us how you heard about us.';
				$errors[] = $str; 
				setFlashMessage('error', $str);
			}
		}

		//go back to the page if validation failed
		if (!empty($errors)){
			//clear the session just in case something was wrong this time.
			unset($_SESSION['section_1']); 
			return; 

		//if all went well then just remember the answers in the session
		} else {

			//sanitization before db
			$data['name'] = sanitize_text_field($section['name']); 
			$data['email'] = sanitize_email($section['email']);
			$data['dob'] = sanitize_text_field($section['dob']);
			$data['address'] = sanitize_text_field($section['address']);
			$data['phone'] = sanitize_text_field($section['phone']);
			$data['post_code'] = sanitize_text_field($section['post_code']);
			$data['password'] = $section['password'];
			$data['feedback_1'] = sanitize_text_field($section['feedback_1']);
			$data['feedback_2'] = sanitize_text_field($section['feedback_2']);
			$data['occupation'] = sanitize_text_field($section['occupation']);

			
			$this->saveNewProfile($data);
			wp_redirect( home_url().'/profile/sizing' ); 
			exit;	
		}
		
	}


	public function saveNewProfile($profile){
		debug_log('Trying to create user without either password or email');
		
		//check that we have what it takes to create the user
		if (empty($profile['email']) || empty($profile['password'])) {
			debug_log('Trying to create user without either password or email');
			wp_redirect(home_url());
			exit;
		}
		//create a new user
		$new_user_id = $this->main->users_model->createUser($profile['email'], $profile['password']);

		//if there is a problem creating
		if (is_object($new_user_id)){
			debug_log('There was a problem creating the user '.__FILE__);

			if (!empty($new_user_id['existing_user_login'])){
				debug_log('The user already exists. Needs to login instead of register');
			}
			wp_redirect(home_url());
			exit;
		}

		$data = array();
		$data['profile_id'] = (int) $new_user_id;
		$data['email'] 		= $profile['email'];
		$data['first_name'] = $profile['name'];
		$data['phone'] 		= $profile['phone'];
		$data['dob'] 		= $profile['dob'];
		$data['occupation'] = $profile['occupation'];
		$this->main->profiles_model->save($data);
	}



	public function process_sizing_form(){
		$data = 'this is the data';
		wp_redirect( home_url().'/profile/style' ); 
		exit;
	}

	public function process_style_form(){
		$data = 'this is the data';
		global $current_user;
		$this->main->sendmail($current_user->data->user_email, 'Thank you!', Emails_model::TEMPLATE_THANK_YOU, $data);
		wp_redirect( home_url().'/profile/authorize' ); 
		exit;
	}


} //end of class

