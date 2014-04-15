<?php
/**
*
* Plugin Name: LDM WP Sagepay 
* Description: A custom built plugin to provide sagepay payment functionality
* Author: Rodrigo Dias
* Author URI: http://likedigitalmedia.com
* Version: 0.1
* Provides: ldm_sagepay
*
**/


require_once 'sagepay-form.php';

class ldm_sagepay {

	public $config = array(); 
	
	public function __construct() {
		$this->config['encryption_key'] 	= '9e40c05e600d6300'; 
		$this->config['txtype'] 			= 'AUTHENTICATE';
		$this->config['protocol_version'] 	= '3.00';
		$this->config['vendor_name'] 		= 'EnclothedLtd';
		$this->config['currency'] 			= 'GBP';
		$this->config['total'] 				= '1.00';
		$this->config['description'] 		= 'Enclothed concierge service.';
		$this->config['customer_name']		= 'Rodrigo Dias';
		$this->config['billing_first_names'] = 'Rodrigo';
		$this->config['billing_surname'] 	= 'Dias';
		$this->config['billing_address1']	= '14';
		$this->config['billing_address2']	= 'Old Street';
		$this->config['billing_city']		= 'London';
		$this->config['billing_postcode']	= 'E3 3HR';
		$this->config['billing_country']	= 'GB';
		$this->config['billing_phone']		= '';
		$this->config['success_url']		= 'http://enclothed.dev/thank-you';
		$this->config['failure_url']		= 'http://enclothed.dev/unsuccessful';
	}

	public function getConfig(){
		return $this->config; 
	}

	public function getInstance($config = ''){
		if (empty($config)){
			$config = $this->getConfig();
		}
		return new Sagepay($config);	
	}
} 







?>
