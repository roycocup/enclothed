<?php

/**
 * Sage Pay Form class
 *
 * This CodeIgniter library to integrate the Sage Pay Go Form service
 * http://www.sagepay.com/products_services/sage_pay_go/integration/form
 * 
 * @package   sagepay_form
 * @author    Ollie Rattue, Too many tabs <orattue[at]toomanytabs.com>
 * @copyright Copyright (c) 2011, Ollie Rattue
 * @license   http://www.opensource.org/licenses/mit-license.php
 * @link      https://github.com/ollierattue/codeigniter-sagepay-form
 */

class Sagepay {

	public $protocol_version = "3.00";
	public $config;
	public $vendor_name;
	public $your_site_fqdn;
	public $transaction_type;
	public $encryption_password;
	public $purchase_url;
	public $partner_id;
	public $currency;
	public $vendor_tx_code;
	public $total;
	public $description;
	public $billing_first_names;
	public $billing_surname;
	public $billing_address1;
	public $billing_address2;
	public $billing_city;
	public $billing_postcode;
	public $billing_country;
	public $billing_state;
	public $billing_phone;
	public $delivery_first_names;
	public $delivery_surname;
	public $delivery_address1;
	public $delivery_address2;
	public $delivery_city;
	public $delivery_postcode;
	public $delivery_country;
	public $delivery_state;
	public $delivery_phone;
	public $send_email;
	public $vendor_email;
	public $customer_email;
	public $email_message;
	public $allow_gift_aid = 0;
	public $billing_agreement = 0;
	public $apply_avscv2 = 0;
	public $apply_3d_secure = 0;
	public $submit_btn; // Image/Form button
	public $CI;
	
	/**
	 * Constructor
	 *
	 * @access	public
	 */

	public function __construct()
	{
		
		$this->vendor_name 			= 'Enclothedldt';
		$this->your_site_fqdn 		= 'your_site_fqdn';
		$this->encryption_password 	= '9e40c05e600d6300';
		$this->partner_id 			= 'partner_id';
		$this->currency 			= 'gbp';
		$this->transaction_type 	= 'deferred';
		$this->send_email 			= 'rodrigo@rodderscode.co.uk';
		$this->vendor_email 		= 'rodrigo@rodderscode.co.uk';
		$this->purchase_url 		= 'https://test.sagepay.com/gateway/service/vspserver-register.vsp';
		$this->success_url			= 'http://enclothed.dev/thank_you';
		$this->failure_url			= 'http://enclothed.dev/cancel';
	}

	public function form_close($extra = ''){
			return "</form>".$extra;
	}
	

	public function form_prep($str = '', $field_name = '')
	{
		static $prepped_fields = array();

		// if the field name is an array we do this recursively
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = form_prep($val);
			}

			return $str;
		}

		if ($str === '')
		{
			return '';
		}

		// we've already prepped a field with this name
		// @todo need to figure out a way to namespace this so
		// that we know the *exact* field and not just one with
		// the same name
		if (isset($prepped_fields[$field_name]))
		{
			return $str;
		}

		$str = htmlspecialchars($str);

		// In case htmlspecialchars misses these.
		$str = str_replace(array("'", '"'), array("&#39;", "&quot;"), $str);

		if ($field_name != '')
		{
			$prepped_fields[$field_name] = $field_name;
		}

		return $str;
	}

	public function form_hidden($name, $value = '', $recursing = FALSE)
	{
		static $form;

		if ($recursing === FALSE)
		{
			$form = "\n";
		}

		if (is_array($name))
		{
			foreach ($name as $key => $val)
			{
				form_hidden($key, $val, TRUE);
			}
			return $form;
		}

		if ( ! is_array($value))
		{
			$form .= '<input type="hidden" name="'.$name.'" value="'.$this->form_prep($value, $name).'" />'."\n";
		}
		else
		{
			foreach ($value as $k => $v)
			{
				$k = (is_int($k)) ? '' : $k;
				form_hidden($name.'['.$k.']', $v, TRUE);
			}
		}

		return $form;
	}

	// --------------------------------------------------------------------
	
	function set_field($field = NULL, $value = NULL)
	{
		$this->{$field} = $value;
	}

	// --------------------------------------------------------------------
	
	function set_same_delivery_address()
	{
		$this->delivery_first_names = $this->billing_first_names;
		$this->delivery_surname = $this->billing_surname;
		$this->delivery_address1 = $this->billing_address1;
		$this->delivery_address2 = $this->billing_address2;
		$this->delivery_city = $this->billing_city;
		$this->delivery_postcode = $this->billing_postcode;
		$this->delivery_country = $this->billing_country;
		$this->delivery_state = $this->billing_state;
		$this->delivery_phone = $this->billing_phone;
	}

	// --------------------------------------------------------------------
		
	// Creates a unique string
	// Called by controller and the value would be stored in db against the purchase
	function create_vendor_tx_code()
	{
		$timestamp = date("y-m-d-H-i-s", time());
		$random_number = rand(0,32000)*rand(0,32000);
		$this->vendor_tx_code = "{$timestamp}-{$random_number}";
		
		return $this->vendor_tx_code;
	}

	// --------------------------------------------------------------------
	
	function form($form_name = 'SagePayForm')
	{
		$strCrypt = $this->_build_form_crypt();
		
		$str = '<form action="'.$this->purchase_url.'" method="POST" id="SagePayForm" name="'.$form_name.'">' . "\n";
		
		$str .= $this->form_hidden('navigate', "") . "\n";
		$str .= $this->form_hidden('VPSProtocol', $this->protocol_version) . "\n";
		$str .= $this->form_hidden('TxType', $this->transaction_type) . "\n";
		$str .= $this->form_hidden('Vendor', $this->vendor_name) . "\n";
		$str .= $this->form_hidden('Crypt', $strCrypt) . "\n";
											
		$str .= $this->submit_btn;
		$str .= $this->form_close() . "\n";

		return $str;
	}

	// --------------------------------------------------------------------
	
	// This function actually generates an entire HTML page consisting of
	// a form with hidden elements which is submitted to Sage Pay via the 
	// BODY element's onLoad attribute.  We do this so that you can validate
	// any POST vars from your custom form before submitting to Sage Pay.  
	
	// You would have your own form which is submitted to your script
	// to validate the data, which in turn calls this function to create
	// another hidden form and submit to Sage Pay.
	
	function auto_form()
	{
		$this->button('Click here if you\'re not automatically redirected...');

		echo '<html>' . "\n";
		echo '<head><title>Processing Payment...</title></head>' . "\n";
		echo '<body onLoad="document.forms[\'sagepay_auto_form\'].submit();">' . "\n";
		echo '<p>Please wait, your order is being processed and you will be redirected to our payment partner.</p>' . "\n";
		echo $this->form('sagepay_auto_form');
		echo '</body></html>';
	}

	// --------------------------------------------------------------------
	
	function button($value = NULL)
	{
		// changes the default caption of the submit button
		$this->submit_btn = form_submit('sagepay_submit', $value);
	}

	// --------------------------------------------------------------------
	
	function _build_form_crypt()
	{
		// ** TODO ADD in basket basket support **
		
		// Now to build the Form crypt field.
		if ($this->vendor_tx_code == '')
		{
			// This is a fallback in the instance that the controller
			// did not call this function which it should to store the
			// value in the db for records.
			$this->create_vendor_tx_code();
		}
		
		$strPost = "VendorTxCode={$this->vendor_tx_code}";
		
		// Optional: If you are a Sage Pay Partner and wish to flag the transactions with your unique partner id, it should be passed here
		if (strlen($this->partner_id) > 0)
		{
		    $strPost .= "&ReferrerID={$this->partner_id}";			
		}

		$strPost .= "&Amount=".number_format($this->total, 2); // Formatted to 2 decimal places with leading digit
		$strPost .= "&Currency={$this->currency}";
		
		// Up to 100 chars of free format description
		$strPost .= "&Description={$this->description}"; //*********** HARD CODDED ****************

		/* The SuccessURL is the page to which Form returns the customer if the transaction is successful 
		** You can change this for each transaction, perhaps passing a session ID or state flag if you wish */
		$strPost .= "&SuccessURL={$this->your_site_fqdn}{$this->success_url}"; //*********** HARD CODDED ****************

		/* The FailureURL is the page to which Form returns the customer if the transaction is unsuccessful
		** You can change this for each transaction, perhaps passing a session ID or state flag if you wish */
		$strPost .= "&FailureURL={$this->your_site_fqdn}{$this->failure_url}"; //*********** HARD CODDED ****************

		// This is an Optional setting. Here we are just using the Billing names given.
		$strPost .= "&CustomerName={$this->billing_first_names} {$this->billing_surname}";
		
		/* Email settings:
		** Flag 'SendEMail' is an Optional setting. 
		** 0 = Do not send either customer or vendor e-mails, 
		** 1 = Send customer and vendor e-mails if address(es) are provided(DEFAULT). 
		** 2 = Send Vendor Email but not Customer Email. If you do not supply this field, 1 is assumed and e-mails are sent if addresses are provided. **/
		if ($this->send_email == 0)
		{
			$strPost .= "&SendEMail=0";
		}
		else
		{
			if ($this->send_email == 1) 
			{
		    	$strPost .= "&SendEMail=1";
		    } 
			else 
			{
		    	$strPost .= "&SendEMail=2";
		    }

		    if (strlen($this->customer_email) > 0)
			{
				$strPost .= "&CustomerEMail={$this->customer_email}";  // This is an Optional setting
			}
		        
		    if ($this->vendor_email <> "")
			{
				$strPost .= "&VendorEMail={$this->vendor_email}";  // This is an Optional setting
			}
			    
		    // You can specify any custom message to send to your customers in their confirmation e-mail here
		    // The field can contain HTML if you wish, and be different for each order.  This field is optional
		    if (strlen($this->email_message) > 0)
			{
				$strPost .= "&eMailMessage={$this->email_message}";
			}
		}

		// Billing Details:
		$strPost .= "&BillingFirstnames={$this->billing_first_names}";
		$strPost .= "&BillingSurname={$this->billing_surname}";
		$strPost .= "&BillingAddress1={$this->billing_address1}";
		
		if (strlen($this->billing_address2) > 0)
		{
			$strPost .= "&BillingAddress2={$this->billing_address2}";	
		}
		
		$strPost .= "&BillingCity={$this->billing_city}";
		$strPost .= "&BillingPostCode={$this->billing_postcode}";
		$strPost .= "&BillingCountry={$this->billing_country}";
		
		if (strlen($this->billing_state) > 0)
		{
			$strPost .= "&BillingState={$this->billing_state}";
		}
		
		if (strlen($this->billing_phone) > 0)
		{
			$strPost .= "&BillingPhone={$this->billing_phone}";
		}

		// Delivery Details:
		$strPost .= "&DeliveryFirstnames={$this->delivery_first_names}";
		$strPost .= "&DeliverySurname={$this->delivery_surname}";
		$strPost .= "&DeliveryAddress1={$this->delivery_address1}";
		
		if (strlen($this->delivery_address2) > 0)
		{
			$strPost .= "&DeliveryAddress2={$this->delivery_address2}";
		}
		$strPost .= "&DeliveryCity={$this->delivery_city}";
		$strPost .= "&DeliveryPostCode={$this->delivery_postcode}";
		$strPost .= "&DeliveryCountry={$this->delivery_country}";
		
		if (strlen($this->delivery_state) > 0)
		{
			$strPost .= "&DeliveryState={$this->delivery_state}";	
		}
		
		if (strlen($this->delivery_phone) > 0)
		{
			$strPost .= "&DeliveryPhone={$this->delivery_phone}";
		}
		
		// For charities registered for Gift Aid, set to 1 to display the Gift Aid check box on the payment pages
		if ($this->allow_gift_aid == 1)
		{
			$strPost .= "&AllowGiftAid=1"; //*********** HARD CODDED ****************
		}
		else
		{
			$strPost .= "&AllowGiftAid=0";
		}
		
		/* Allow fine control over AVS/CV2 checks and rules by changing this value. 0 is Default 
		** It can be changed dynamically, per transaction, if you wish. See the Form Protocol document */
		if ($this->transaction_type !== "AUTHENTICATE")
		{
			switch($this->apply_avscv2)
			{
				case "1":
				case "2":
				case "3":
					$strPost .= "&ApplyAVSCV2={$this->apply_avscv2}";
				break;

				default:
					$strPost .= "&ApplyAVSCV2=0";
				break;
			}
		}
		
		/* Allow fine control over 3D-Secure checks and rules by changing this value. 0 is Default 
		** It can be changed dynamically, per transaction, if you wish.  See the Form Protocol document */
		
		switch($this->apply_3d_secure)
		{
			case "1":
			case "2":
			case "3":
				$strPost .= "&Apply3DSecure={$this->apply_3d_secure}"; //*********** HARD CODDED ****************
			break;

			default:
				$strPost .= "&Apply3DSecure=0"; //*********** HARD CODDED ****************
			break;
		}
		
		/* This field must be set for PAYPAL REFERENCE transactions 
		All non-PayPal transactions can be repeated without this 
		flag.
		
		If you wish to register this transaction as the first in a series of 
		regular payments, this field should be set to 1.  
		
		If you do not have a PayPal account set up for use via Sage Pay, then this field 
		is not necessary and should be omitted or set to 0. */
		if ($this->billing_agreement == 1)
		{
			$strPost .= "&BillingAgreement=1";
		}
		else
		{
			$strPost .= "&BillingAgreement=0";
		}
		
		// Encrypt the plaintext string for inclusion in the hidden field
		$strCrypt = $this->_encode_crypt($strPost);
		
		return $strCrypt;
	}
	
	// --------------------------------------------------------------------
	
	/* The getToken function.                                                                                       **
	** NOTE: A function of convenience that extracts the value from the "name=value&name2=value2..." reply string 	**
	** Works even if one of the values is a URL containing the & or = signs.                                      	*/

	function getToken($thisString) {

	  // List the possible tokens
	  $Tokens = array(
	    "Status",
	    "StatusDetail",
	    "VendorTxCode",
	    "VPSTxId",
	    "TxAuthNo",
	    "Amount",
	    "AVSCV2", 
	    "AddressResult", 
	    "PostCodeResult", 
	    "CV2Result", 
	    "GiftAid", 
	    "3DSecureStatus", 
	    "CAVV",
		"AddressStatus",
		"CardType",
		"Last4Digits",
		"PayerStatus","CardType");

	  // Initialise arrays
	  $output = array();
	  $resultArray = array();

	  // Get the next token in the sequence
	  for ($i = count($Tokens)-1; $i >= 0 ; $i--){
	    // Find the position in the string
	    $start = strpos($thisString, $Tokens[$i]);
		// If it's present
	    if ($start !== false){
	      // Record position and token name
	      $resultArray[$i]->start = $start;
	      $resultArray[$i]->token = $Tokens[$i];
	    }
	  }

	  // Sort in order of position
	  sort($resultArray);
		// Go through the result array, getting the token values
	  for ($i = 0; $i<count($resultArray); $i++){
	    // Get the start point of the value
	    $valueStart = $resultArray[$i]->start + strlen($resultArray[$i]->token) + 1;
		// Get the length of the value
	    if ($i==(count($resultArray)-1)) {
	      $output[$resultArray[$i]->token] = substr($thisString, $valueStart);
	    } else {
	      $valueLength = $resultArray[$i+1]->start - $resultArray[$i]->start - strlen($resultArray[$i]->token) - 2;
		  $output[$resultArray[$i]->token] = substr($thisString, $valueStart, $valueLength);
	    }      

	  }

	  // Return the ouput array
	  return $output;
	}

	// --------------------------------------------------------------------
	
	// Filters unwanted characters out of an input string.  Useful for tidying up FORM field inputs.
	function _cleanInput($strRawText,$strType) 
	{

		if ($strType=="Number") {
			$strClean="0123456789.";
			$bolHighOrder=false;
		}
		else if ($strType=="VendorTxCode") {
			$strClean="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
			$bolHighOrder=false;
		}
		else {
	  		$strClean=" ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,'/{}@():?-_&£$=%~<>*+\"";
			$bolHighOrder=true;
		}

		$strCleanedText="";
		$iCharPos = 0;

		do
			{
	    		// Only include valid characters
				$chrThisChar=substr($strRawText,$iCharPos,1);

				if (strspn($chrThisChar,$strClean,0,strlen($strClean))>0) { 
					$strCleanedText=$strCleanedText . $chrThisChar;
				}
				else if ($bolHighOrder==true) {
					// Fix to allow accented characters and most high order bit chars which are harmless 
					if (bin2hex($chrThisChar)>=191) {
						$strCleanedText=$strCleanedText . $chrThisChar;
					}
				}

			$iCharPos=$iCharPos+1;
			}
		while ($iCharPos<strlen($strRawText));

	  	$cleanInput = ltrim($strCleanedText);
		return $cleanInput;

	}
	
	// --------------------------------------------------------------------
	
	// Wrapper function to encrypt data to store in hidden field which is sent to Sage Pay
	function _encode_crypt($post = NULL)
	{
		return $this->_base64Encode($this->_SimpleXor($post, $this->encryption_password));
	}
	
	// --------------------------------------------------------------------
	
	// Wrapper function to decrypt the response data sent back from Sage Pay to success/failure url via url string
	function decode_crypt($crypt = NULL)
	{
		return $this->_simpleXor($this->_base64Decode($crypt), $this->encryption_password);
	}
	
	// --------------------------------------------------------------------
	
	/* Base 64 Encoding function **
	** PHP does it natively but just for consistency and ease of maintenance, let's declare our own function **/

	function _base64Encode($plain) {
	  // Initialise output variable
	  $output = "";

	  // Do encoding
	  $output = base64_encode($plain);

	  // Return the result
	  return $output;
	}

	// --------------------------------------------------------------------
	
	/* Base 64 decoding function **
	** PHP does it natively but just for consistency and ease of maintenance, let's declare our own function **/

	function _base64Decode($scrambled) {
	  // Initialise output variable
	  $output = "";

	  // Fix plus to space conversion issue
	  $scrambled = str_replace(" ","+",$scrambled);

	  // Do encoding
	  $output = base64_decode($scrambled);

	  // Return the result
	  return $output;
	}

	// --------------------------------------------------------------------

	/*  The SimpleXor encryption algorithm                                                                                **
	**  NOTE: This is a placeholder really.  Future releases of Form will use AES or TwoFish.  Proper encryption      	  **
	**  This simple function and the Base64 will deter script kiddies and prevent the "View Source" type tampering        **
	**  It won't stop a half decent hacker though, but the most they could do is change the amount field to something     **
	**  else, so provided the vendor checks the reports and compares amounts, there is no harm done.  It's still          **
	**  more secure than the other PSPs who don't both encrypting their forms at all                                      */

	function _simpleXor($InString, $Key) 
	{
	  // Initialise key array
	  $KeyList = array();
	  // Initialise out variable
	  $output = "";

	  // Convert $Key into array of ASCII values
	  for($i = 0; $i < strlen($Key); $i++){
	    $KeyList[$i] = ord(substr($Key, $i, 1));
	  }

	  // Step through string a character at a time
	  for($i = 0; $i < strlen($InString); $i++) {
	    // Get ASCII code from string, get ASCII code from key (loop through with MOD), XOR the two, get the character from the result
	    // % is MOD (modulus), ^ is XOR
	    $output.= chr(ord(substr($InString, $i, 1)) ^ ($KeyList[$i % strlen($Key)]));
	  }

	  // Return the result
	  return $output;
	}

	// --------------------------------------------------------------------
	
	// Function to check validity of email address entered in form fields
	function _is_valid_email($email)
	{
	  $result = TRUE;
	  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
	    $result = FALSE;
	  }
	  return $result;
	}
	
	// --------------------------------------------------------------------
}

/* End of file sagepay_form.php */
/* Location: ./application/libraries/sagepay_form.php */