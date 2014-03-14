<?php

/**
*
* Plugin Name: Enclothed Forms
* Provides: enc_forms
* Description: A custom built plugin to intake and process specific user profile forms
* Author: Like Digital Media
* Url: http://likedigitalmedia.com
* Version: 0.1
*
**/



require_once(dirname(__FILE__)."/helpers.php");
require_once(dirname(__FILE__)."/models/emails.php");


add_action('init', 'enc_forms_init');
function enc_forms_init(){
	new EnclothedForms();
}

class EnclothedForms {

	
	public function __construct(){
			
	}


} //end of class

