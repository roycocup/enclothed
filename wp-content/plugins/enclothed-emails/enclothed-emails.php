<?php

/**
*
* Plugin Name: Enclothed Emails
* Description: A custom built plugin to enable emails to be sent from a bespoke database table
* Author: Like Digital Media
* Url: http://likedigitalmedia.com
* Version: 0.1
* Provides: enc_emails
*
**/



require_once(dirname(__FILE__)."/helpers.php");
require_once(dirname(__FILE__)."/models/emails.php");


add_action('init', 'enc_emails_init');
function enc_emails_init(){
	new EnclothedEmails();
}

class EnclothedEmails {

	public $model;
	
	public function __construct(){
		$this->model = new Emails_model();
	}


	public function sendmail($to, $subject, $template_name, $data){
		//pick an template
		$template = $this->model->getMailTemplate($template_name);
		$content = $this->model->_replace($template, $data);
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";

		wp_mail($to, $subject, $content, $headers);
		$this->model->saveEmail($template_name, $to, $content);
	}

			
	//anything else
	//$this->emails->sendmail($primary->email, __('Thank you!', 'duckjoy_orders'), Emails_model::TEMPLATE_THANK_YOU, $data);
	//wp_redirect('/');
	//setFlashMessage('error', __('Your paypal order was canceled.', 'duckjoy_orders') );


} //end of class





