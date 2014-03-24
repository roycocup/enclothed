<?php

/**
*
* Plugin Name: Enclothed Main
* Description: A custom built plugin to enable the main bespoke functionality for the enclothed website
* Author: Like Digital Media
* Author URI: http://likedigitalmedia.com
* Version: 0.1
* Provides: enc_main
*
**/



require_once(dirname(__FILE__)."/helpers.php");
require_once(dirname(__FILE__)."/models/emails.php");
require_once(dirname(__FILE__)."/models/brands.php");
require_once(dirname(__FILE__)."/models/users.php");
require_once(dirname(__FILE__)."/models/profiles.php");



add_action('init', 'enc_main_init');
function enc_main_init(){
	$enclothed = new EnclothedMain();
	//$enclothed->updateBrands();
	add_shortcode('brands', array($enclothed, 'displayBrands')); 
}

class EnclothedMain {

	public $emails_model; 
	public $brands_model; 
	public $users_model; 
	public $profiles_model; 

	
	public function __construct(){
		$this->emails_model = new Emails_model();
		$this->brands_model = new Brands_model();
		$this->users_model = new Users_model();
		$this->profiles_model = new Profiles_model();
		add_action("wp_ajax_enc_ajax_getvars", array($this, "enc_ajax_getvars"));
		add_action("wp_ajax_nopriv_enc_ajax_getvars", array($this, 'enc_ajax_getvars'));
		
	}


	/**
	*
	* Enabling email sending using a model that looks for templates in the database
	*
	**/
	public function sendmail($to, $subject, $template_name, $data){
		//pick an template
		$template = $this->emails_model->getMailTemplate($template_name);
		//replace the placeholders
		$content = $this->emails_model->_replace($template, $data);
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
		$headers .= 'From: Enclothed <enclothed@enclothed.co.uk>' . "\r\n";
		//actually send the email
		wp_mail($to, $subject, $content, $headers);
		//save the email to the database emails table
		$this->emails_model->saveEmail($template_name, $to, $content);
	}


	public function displayBrands(){
		$brands = $this->brands_model->getBrandsList();
		$str = ''; //final string to be displayed; 
		foreach ($brands as $key => $brand) {
			$logo = $brand->brand_logo; 
			$name = $brand->brand_name; 
			$str .= "<h4>{$name}</h4>";
			$str .= "<div class='thumbnail image' name='{$name}'><img src='{$logo}' alt='{$name}'/></div>" ; 
		}

		return $str; 
	}


	public function updateBrands (){
		// $manual_brands =  array('Abercrombie & Fitch' => 'Abercrombie & Fitchiiiiiii', );
		$manual_brands = array();
		$this->brands_model->updateDbBrands(true, $manual_brands);
	}



	/**
	* Endpoint for all ajax calls
	*/
	public function enc_ajax_getvars(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$function_name = @$_REQUEST['function_name'];
			$parameters = @$_REQUEST['parameters'];
			if (!empty($parameters)) {
				$result = $this->$function_name($parameters);	
			} else {
				$result = $this->$function_name();	
			}
			echo json_encode($result);
			exit();
		}
	}

	/**
	*
	* Ajax function for logon
	*
	**/
	private function _ajax_login($parameters){
		$user = $parameters[0];
		$pass = $parameters[1];
		
		$creds['user_login'] = $user;
		$creds['user_password'] = $pass;
		$creds['remember'] = true;
		$user = wp_signon( $creds, false );
		if (empty($user) || get_class($user) == 'WP_Error'){
			return 'no';
		} else if(get_class($user) == 'WP_User'){
			return 'yes';
		}
	}






} //end of class





