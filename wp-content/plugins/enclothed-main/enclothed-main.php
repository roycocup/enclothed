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



add_action('init', 'enc_main_init');
function enc_main_init(){
	new EnclothedMain();
}

class EnclothedMain {

	public $emails_model; 
	
	public function __construct(){
		$this->emails_model = new Emails_model();
	}


	/**
	*
	* Enabling email sending using a model that looks for templates in the database
	*
	**/
	public function sendmail($to, $subject, $template_name, $data){
		//pick an template
		$template = $this->emails_model->getMailTemplate($template_name);
		$content = $this->emails_model->_replace($template, $data);
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

		wp_mail($to, $subject, $content, $headers);
		$this->emails_model->saveEmail($template_name, $to, $content);
	}

			
	//anything else
	//$this->emails->sendmail($primary->email, __('Thank you!', 'duckjoy_orders'), Emails_model::TEMPLATE_THANK_YOU, $data);
	//wp_redirect('/');
	//setFlashMessage('error', __('Your paypal order was canceled.', 'duckjoy_orders') );


} //end of class





