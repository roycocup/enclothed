<?php

/**
*
* Plugin Name: Enclothed Emails
* Provides: enc_emails
* Description: A custom built plugin to enable emails to be sent from a bespoke database table
* Author: Like Digital Media
* Url: http://likedigitalmedia.com
* Version: 0.1
*
**/



require_once(dirname(__FILE__)."/helpers.php");
require_once(dirname(__FILE__)."/models/emails.php");


add_action('init', 'enc_emails_init');
function enc_emails_init(){
	new EnclothedEmails();
}

class EnclothedEmails {

	
	public function __construct(){
			
	}

			
	//anything else
	//$this->emails->sendmail($primary->email, __('Thank you!', 'duckjoy_orders'), Emails_model::TEMPLATE_THANK_YOU, $data);
	//wp_redirect('/');
	//setFlashMessage('error', __('Your paypal order was canceled.', 'duckjoy_orders') );


} //end of class





