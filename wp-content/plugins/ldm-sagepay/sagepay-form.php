<?php

class Sagepay {

	public $encryption_key = "9e40c05e600d6300";
	public $crypt; 

	public function __construct(){

		$datapadded = $this->pkcs5_pad($this->getString(),16);
		$this->crypt = "@" . $this->encryptFieldData($datapadded);
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
		$str = 'VendorTxCode=TxCode-1310917599-223087284&Amount=36.95&Currency=GBP&Description=description&CustomerName=Fname 
		Surname&CustomerEMail=customer@example.com&BillingSurname=Surname&BillingFirstnames=Fname&BillingAddress1=BillAddress 
		Line 1&BillingCity=BillCity&BillingPostCode=W1A 
		1BL&BillingCountry=GB&BillingPhone=447933000000&DeliveryFirstnames=Fname&DeliverySurname=Surname&DeliveryAddress1=BillAd
		dress Line 1&DeliveryCity=BillCity&DeliveryPostCode=W1A 
		1BL&DeliveryCountry=GB&DeliveryPhone=447933000000&SuccessURL=http://example.com/success&FailureURL=http://example.com/failure';	
		return $str;
	}

	

	public function renderForm(){
		$form = '
			<form name="pp_form" action="https://test.sagepay.com/gateway/service/vspform-register.vsp" method="post">
				<input name="VPSProtocol" type="hidden" value="3.00" />
				<input name="TxType" type="hidden" value="PAYMENT" />
				<input name="Vendor" type="hidden" value="EnclothedLtd" />
				<input name="Currency" type="hidden" value="GBP" />
				<input name="Crypt" type="hidden" value="'.$this->crypt.'" />
				<p>Click here to submit 
					<input type="submit" value="Send">
				</p>
			</form>';
		return $form;

	}

}