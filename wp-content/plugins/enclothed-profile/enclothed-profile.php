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
	const BYPASS_VALIDATION = false; //turn this off when going to production

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
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/style/' ) ) {
				$this->process_style_form();
			}	
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/preferences/' ) ) {
				$this->process_preferences_form();
			}
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/sizing/' ) ) {
				$this->process_sizing_form();
			}
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/pricing/' ) ) {
				$this->process_pricing_form();
			}
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/delivery/' ) ) {
				$this->process_delivery_form();
			}
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/authorize/' ) ) {
				$this->process_authorize_form();
			}
		}
	}

	/**
	*
	* This creates a new user in wordpress and a new profile on a custom table enc_profile.
	* @param array - email, name, phone, dob, occupation
	* @return int (id for new user) or string for error 
	*
	**/
	public function saveNewProfile($profile){
		

		//check that we have what it takes to create the user
		if (empty($profile['email']) || empty($profile['password'])) {
			debug_log('Trying to create user without either password or email');
			wp_redirect(home_url());
			exit;
		}

		//create a new user
		$new_user_id = $this->main->users_model->createUser($profile['email'], $profile['password']);
		// $new_user_id = 1; 

		//if there is a problem creating
		if (is_object($new_user_id)){
			debug_log('There was a problem creating the user '.__FILE__);
			
			if (!empty($new_user_id->errors['existing_user_login'])){
				debug_log('The user already exists. Maybe coming back to update?');
				$user_id = get_user_by( 'email', $profile['email'] )->data->ID; 
			}
			// debug_log('Something bad happen when trying to create a new user. Redirecting to homepage.'); 
			// wp_redirect(home_url());
			// exit;
		}
		debug_log('Saving new profile for '. $profile['email'] ); 
		


		//the form only takes the full name so we need to break it into several
		$names = explode(' ', $profile['name']); 		
		$last_names = '';
		foreach ($names as $k => $value) {
			if ($k == 0) continue; //bypass the first name
			$last_names .= $value.' '; 
		}

		//if the user is coming back to update its details just use this id
		$new_user_id = (!empty($user_id))? $user_id : $new_user_id;

		//formating the date for the db
		$dob = strtotime($profile['dob']);
		$dob = date('Y-m-d', $dob);

		$data = array();
		$data['profile_id'] = (int) $new_user_id;
		$data['email'] 		= $profile['email'];
		$data['customer_id'] 		= substr(md5($new_user_id), 0, 5); //This is the customer unique reference
		$data['first_name'] 		= $names[0];
		$data['last_name'] 			= $last_names;
		$data['phone'] 				= $profile['phone'];
		$data['dob'] 				= $dob;
		$data['town'] 				= $profile['town'];
		$data['post_code'] 			= $profile['post_code'];
		$data['occupation'] 		= $profile['occupation'];
		$data['feedback_1'] 		= $profile['feedback_1'];
		$data['other_person'] 		= $profile['other_person'];

		//save it
		debug_log('Creating or updating a profile now.');
		$res = $this->main->profiles_model->save($data);

		return $new_user_id;
	}



	public function process_details_form(){

		if (isset($_POST['section_1'])){
			//a more convenient variable
			$section = $_POST['section_1']; 
		}

		if (self::BYPASS_VALIDATION){
			wp_redirect( home_url().'/profile/style' ); 
			exit;
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
			preg_match('/^(0?[1-9]|1[012])[\/](0?[1-9]|[12][0-9]|3[01])[\/]\d{4}$/', $section['dob'], $match);
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
			$data['name'] 			= sanitize_text_field($section['name']); 
			$data['email'] 			= sanitize_email($section['email']);
			$data['dob'] 			= sanitize_text_field($section['dob']);
			$data['address'] 		= sanitize_text_field($section['address']);
			$data['phone'] 			= sanitize_text_field($section['phone']);
			$data['post_code'] 		= sanitize_text_field($section['post_code']);
			$data['town'] 			= sanitize_text_field($section['town']);
			$data['password'] 		= $section['password'];
			$data['feedback_1'] 	= (!empty($section['feedback_1']))? sanitize_text_field($section['feedback_1']) : '';
			$data['other_person'] 	=  (!empty($section['other_person']))? sanitize_text_field($section['other_person']) : '';
			$data['occupation'] 	= sanitize_text_field($section['occupation']);

			// $this->main->sendmail($current_user->data->user_email, 'Thank you!', Emails_model::TEMPLATE_THANK_YOU, $data);
			$new_user_id = $this->saveNewProfile($data);

			//everything seems to be ok so lets store this in the session before redirecting
			unset($_SESSION['section_1']);
			$_SESSION['section_1'] = $data;
			//clear before changing
			unset($_SESSION['user']);
			$_SESSION['user']['id'] = $new_user_id;
			$_SESSION['user']['email'] = $data['email'];

			//send to next page
			wp_redirect( home_url().'/profile/style' ); 
			exit;	
		}
		
	}

	public function process_style_form(){
		$section_2 = $_POST['section_2'];
		$styles = array_keys($section_2);
		$styles = implode(',', $styles);

		//just fail if no user in the session
		if (empty($_SESSION['user'])){
			debug_log('Trying to save section 2 but no user on the session. Redirecting to homepage.');
			wp_redirect( home_url() ); 	
			exit;
		}

		$data['styles'] = $styles;
		$data['profile_id'] = $_SESSION['user']['id'];
		$data['email'] = $_SESSION['user']['email'];

		//save it
		$res = $this->main->profiles_model->save($data);
		unset($_SESSION['section_2']);
		$_SESSION['section_2'] = $data;
		wp_redirect( home_url().'/profile/preferences' ); 
		exit;
	}

	public function process_preferences_form(){
		$section_3 = $_POST['section_3'];
		$preferences = array_keys($section_3);
		$preferences = implode(',', $preferences);

		//just fail if no user in the session
		if (empty($_SESSION['user'])){
			debug_log('Trying to save section 2 but no user on the session. Redirecting to homepage.');
			wp_redirect( home_url() ); 	
			exit;
		}

		$data['preferences'] = $preferences;
		$data['profile_id'] = $_SESSION['user']['id'];
		$data['email'] = $_SESSION['user']['email'];

		//save it
		$res = $this->main->profiles_model->save($data);
		unset($_SESSION['section_3']);
		$_SESSION['section_3'] = $data;
		wp_redirect( home_url().'/profile/sizing' ); 
		exit;
	}


	public function process_sizing_form(){
		$data = 'this is the data';
		wp_redirect( home_url().'/profile/pricing' ); 
		exit;
	}

	public function process_pricing_form(){
		//$this->redeemGiftCode($_POST['section_4']['giftcode']); 
		if (!empty($_POST['section_5'])){
			if (!empty($_POST['section_5']['shirt_price'])){
				$shirt_price = utf8_decode($_POST['section_5']['shirt_price']);
			}
			if (!empty($_POST['section_5']['trousers_price'])){
				$trousers_price = utf8_decode($_POST['section_5']['trousers_price']);
			}
			if (!empty($_POST['section_5']['coat_price'])){
				$coat_price = utf8_decode($_POST['section_5']['coat_price']);
			}
			if (!empty($_POST['section_5']['shoe_price'])){
				$shoe_price = utf8_decode($_POST['section_5']['shoe_price']);
			}
		}

		// var_dump($shirt_price, $trousers_price, $coat_price, $shoe_price); 
		// die;
		
		$data = 'this is the data';
		wp_redirect( home_url().'/profile/delivery' ); 
		exit;
	}

	public function process_delivery_form(){
		$data = 'this is the data';
		wp_redirect( home_url().'/profile/authorize' ); 
		exit;
	}

	public function process_authorize_form(){
		$data = 'this is the data';
		global $current_user;
		//$this->main->sendmail($current_user->data->user_email, 'Thank you!', Emails_model::TEMPLATE_THANK_YOU, $data);
		wp_redirect( home_url().'/thank-you' ); 
		exit;
	}


	public function process_collections_form(){

	}


	//redeeming a code for an amount
	//the code must match the amount in the database
	public function redeemGiftCode($code = ''){
		if (empty($code)) return false;	
		$code = $this->main->gifts_model->saveGiftCode('rodrigo@rodderscode.co.uk', 'rodrigo@likedigitalmedia.com', '500');
		$decrypted = $this->main->gifts_model->redeemCode($code);
		// dump($code); 
		// dump($decrypted);
		// die;
		//code exists and is correct?
		// $this->main->gifts_model->validate_code($code);
	}

	


} //end of class

