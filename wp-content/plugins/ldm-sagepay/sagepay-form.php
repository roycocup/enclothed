<?php

/**
*
* Author: Rodrigo Dias
* Contact: rodrigo@rodderscode.co.uk
* Date: 23/03/2014
*
**/

class Sagepay {


	public $encryption_key 		= '';
	public $txtype 				= ''; //'PAYMENT', DEFERRED', 'AUTHENTICATE'
	public $protocol_version 	= '';
	public $vendor_name 		= '';
	public $currency 			= '';
	public $total 				= '';
	public $description 		= '';
	public $customer_name 		= '';

	public $billing_first_names = '';
	public $billing_surname 	= '';
	public $billing_address1 	= '';
	public $billing_address2 	= '';
	public $billing_city 		= '';
	public $billing_postcode 	= '';
	public $billing_country 	= '';
	public $billing_phone 		= '';

	public $delivery_first_names = '';
	public $delivery_surname 	= '';
	public $delivery_address1 	= '';
	public $delivery_address2 	= '';
	public $delivery_city 		= '';
	public $delivery_postcode 	= '';
	public $delivery_country 	= '';
	public $delivery_phone 		= '';

	public $send_email 			= '';
	public $vendor_email 		= '';
	public $customer_email 		= '';
	public $email_message 		= '';
	public $allow_gift_aid 		= 0;
	public $billing_agreement 	= 0;
	public $apply_avscv2 		= 0;
	public $apply_3d_secure 	= 0;

	public $bill_and_delivery_are_same = true; //setup billing to be the same as delivery info?

	public $success_url 		= '';
	public $failure_url 		= '';
	
	private $crypt; 
	private $_sagepay_test_url = 'https://test.sagepay.com/gateway/service/vspform-register.vsp'; 
	private $_sagepay_live_url = 'https://live.sagepay.com/gateway/service/vspform-register.vsp'; 

	public function __construct($config){
		$this->setConfig($config);
		$datapadded = $this->pkcs5_pad($this->getString(),16);
		$this->crypt = "@" . $this->encryptFieldData($datapadded);
	}

	public function setConfig($config){
		foreach ($config as $key => $value) {
			$this->set($key, $value);
		}
	}


	public function set($varname, $value){
		if(property_exists($this, $varname)){
			$this->$varname = $value;
		}
	}

	public function pkcs5_pad($text, $blocksize){
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}

	public function encryptFieldData($input){
		$iv = $this->encryption_key;

		$cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, "", MCRYPT_MODE_CBC, "");
		if (mcrypt_generic_init($cipher, $this->encryption_key, $iv) != -1)
		{
			$cipherText = mcrypt_generic($cipher,$input );
			mcrypt_generic_deinit($cipher);

			$enc = bin2hex($cipherText);
		}
		return $enc;
	}

	public function getString(){
		$str = '';
		$str .= "VendorTxCode=".$this->getTxCode();
		$str .= "&Amount=$this->total";
		$str .= "&Currency={$this->currency}";
		$str .= "&Description={$this->description}";
		$str .= "&CustomerName={$this->customer_name}";
		$str .= "&CustomerEMail={$this->customer_email}";

		$str .= "&BillingFirstnames={$this->billing_first_names}";
		$str .= "&BillingSurname={$this->billing_surname}";
		$str .= "&BillingAddress1={$this->billing_address1}";
		$str .= "&BillingAddress2={$this->billing_address2}";
		$str .= "&BillingCity={$this->billing_city}";
		$str .= "&BillingPostCode={$this->billing_postcode}";
		$str .= "&BillingCountry={$this->billing_country}";
		$str .= "&BillingPhone={$this->billing_phone}";

		if($this->bill_and_delivery_are_same) {
			$str .= "&DeliveryFirstnames={$this->billing_first_names}";
			$str .= "&DeliverySurname={$this->billing_surname}";
			$str .= "&DeliveryAddress1={$this->billing_address1}";
			$str .= "&DeliveryAddress2={$this->billing_address2}";
			$str .= "&DeliveryCity={$this->billing_city}";
			$str .= "&DeliveryPostCode={$this->billing_postcode}";
			$str .= "&DeliveryCountry={$this->billing_country}";
			$str .= "&DeliveryPhone={$this->billing_phone}";	
		} else {
			$str .= "&DeliveryFirstnames={$this->delivery_first_names}";
			$str .= "&DeliverySurname={$this->delivery_surname}";
			$str .= "&DeliveryAddress1={$this->delivery_address1}";
			$str .= "&DeliveryCity={$this->delivery_city}";
			$str .= "&DeliveryPostCode={$this->delivery_postcode}";
			$str .= "&DeliveryCountry={$this->delivery_country}";
			$str .= "&DeliveryPhone={$this->delivery_phone}";
		}
		

		$str .= "&SuccessURL={$this->success_url}"; 
		$str .= "&FailureURL={$this->failure_url}"; 
		
		return $str;
	}

	public function getTxCode(){
		return time(); 
	}

	

	public function renderForm(){
		$form = '
			<form name="pp_form" action="'.$this->_sagepay_test_url.'" method="post">
				<input name="VPSProtocol" type="hidden" value="'.$this->protocol_version.'" />
				<input name="TxType" type="hidden" value="'.$this->txtype.'" />
				<input name="Vendor" type="hidden" value="'.$this->vendor_name.'" />
				<input name="Currency" type="hidden" value="'.$this->currency.'" />
				<input name="Crypt" type="hidden" value="'.$this->crypt.'" />
				';
		return $form;

	}


	public function sagepayDecrypt($strIn) {

		$strEncryptionPassword = $this->encryption_key;

		if (substr($strIn,0,1)=="@") 
		{
			$strIV = $strEncryptionPassword;
			$strIn = substr($strIn,1); 
			$strIn = pack('H*', $strIn);
			return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $strEncryptionPassword, $strIn, MCRYPT_MODE_CBC, $strIV); 
		} else {
			return simpleXor(base64Decode($strIn),$strEncryptionPassword);
		}
	}

}