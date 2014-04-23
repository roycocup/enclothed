<?php
require_once 'db.php';

class Gifts_model extends db{

	private $iv;
	private $key; 
	private $delimiter; 

	public function __construct(){
		parent::__construct();
		$this->iv = mcrypt_create_iv (mcrypt_get_block_size (MCRYPT_TripleDES, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
		$this->key = 'LeeS1bae';
		$this->delimiter = '%%';
	}


	// save code to db 
	public function saveGiftCode($from_email, $to_email, $amount) {
		$code = $this->_createGiftCode($from_email, $to_email, $amount); 
		return $code;
	}

	private function _createGiftCode($from_email, $to_email, $amount){
		$code = '';
		$code = $this->encrypt($from_email.$this->delimiter.$to_email.$this->delimiter.$amount, $this->key);
		return $code;
	}

	public function validateCode($code) {
		$code = $this->decrypt($code, $this->key);
		$code_parts = explode($this->delimiter, $code); 
		return true;
	}

	// code can be redeemed in full or partially
	public function redeemCode($code) {
		$decrypted_code = $this->decrypt($code, $this->key);
		return $decrypted_code;
	}


	public function encrypt($string, $key) {
		$enc = "";
		$enc=mcrypt_cbc (MCRYPT_TripleDES, $key, $string, MCRYPT_ENCRYPT, $this->iv);
		return base64_encode($enc);
	}

	public function decrypt($string, $key) {
		$dec = "";
		$string = trim(base64_decode($string));
		$dec = mcrypt_cbc (MCRYPT_TripleDES, $key, $string, MCRYPT_DECRYPT, $this->iv);
		return $dec;
	}


	

}