<?php 
require_once(dirname(__FILE__).'/wp-bootstrap.php');
require_once(dirname(plugin_dir_path(__FILE__)) . "/enclothed-main/enclothed-main.php");


// check what cron jobs need doing
class Cronjobs extends db{

	public $table = 'wp_enc_profile';
	
	
	public function __construct(){
		parent::__construct();
		$this->main = new EnclothedMain();
	}


	public function log_it( $msg, $status = 'CRON', $file = 'debug_log.txt' ) {
		$location = 
		$msg = gmdate( 'Y-m-d H:i:s' ) . ' - ' . $status . ' - ' .print_r( $msg, TRUE ) . "\n\r";
		print_r($msg);
		file_put_contents( $file , $msg, FILE_APPEND);
	}


	public function sendDigestEmails(){
		
	}

	/**
	*
	* Sends all the accounts to salesforce 
	*
	**/
	public function createSalesforceAccounts(){
		$profiles = $this->getAllProfiles();
		foreach ($profiles as $profile) {
			$this->sendToSalesforce($profile);
		}
	}

	/**
	*
	* Gets all profiles that 
	* - were not sent to salesforce yet.
	* - are through with phase 2 at least
	* - modified is older than an hour
	*
	**/
	public function getAllProfiles(){
		$sql = "SELECT * FROM {$this->table} "; 
		$sql .= " WHERE 1 "; 
		$sql .= "AND salesforce is null"; //never sent to salesforce
		$sql .= " AND modified < DATE_SUB(NOW(), INTERVAL 1 HOUR) "; 
		$rs = $this->wpdb->get_results($sql); 
		return $rs;
	}

	/**
	*
	* Sends a profile to salesforce 
	*
	**/
	public function sendToSalesforce($profile){


		echo ("\nsending to webservices\n\n");
		$ws = new ldmwebservices();
		$fields = array();
		$fields['customerId'] 				= $profile->profile_id;
		$fields['orderReferenceNumber'] 	= '';
		$fields['firstName'] 				= $profile->first_name;
		$fields['lastName'] 				= $profile->last_name;
		$fields['addressLine1'] 			= $profile->address;
		$fields['addressLine2'] 			= '';
		$fields['townCity'] 				= $profile->town;
		$fields['email'] 					= $profile->email;
		$fields['postcode'] 				= $profile->post_code;
		$fields['telephone'] 				= $profile->phone;
		$fields['password'] 				= '';
		$fields['occupation'] 				= $profile->occupation;
		$fields['dob'] 						= $profile->dob;
		$fields['forceLead'] 				= 'true';
		$fields['howDidYouHearAboutEnclothed'] = $profile->feedback_1;
		$fields['howDidYouHearAboutEnclothedOther'] = '';
		$fields['isBuyingForPerson'] = $profile->other_person;
		$fields['buyingForWho'] = '';

		// section 2 - style
		$fields['styleChoices'] = $profile->styles;

		// section 3 - preferences
		$shirts_type = implode(',', $this->getSelectedOptions('shirt_type', $profile->preferences));
		$trousers_colour = implode(',', $this->getSelectedOptions('trousers_colour', $profile->preferences));
		$trousers_type = implode(',', $this->getSelectedOptions('type', $profile->preferences));
		$denim_preferences = implode(',', $this->getSelectedOptions('denim', $profile->preferences));
		$shorts_colour = implode(',', $this->getSelectedOptions('shorts_colours', $profile->preferences));
		$shorts_preferences = implode(',', $this->getSelectedOptions('shorts', $profile->preferences));
		$shoes_preferences = implode(',', $this->getSelectedOptions('shoes', $profile->preferences));
		
		// $brands = $this->getBrands($profile->preferences); 
		$fields['shirtTypeChoice'] = $shirts_type;
		$fields['whereDoYouWearYourShirtChoices'] = $shirts_type;
		$fields['trouserTypeChoice'] = $trousers_type;
		$fields['trouserColourChoices'] = $trousers_colour;
		$fields['jeanStyleChoice'] = $denim_preferences;
		$fields['denimColourChoice'] = $denim_preferences;
		$fields['shortStyleChoice'] = $shorts_preferences;
		$fields['shoeStyleChoices'] = $shoes_preferences;
		$fields['shoeColourChoices'] = $shoes_preferences;

		
		// section 4 - sizing
		$fields['tShirtSize'] = $profile->tshirt_size;
		$fields['neckSize'] = $profile->neck_size;
		$fields['sleeveLength'] = $profile->sleeve_lenght;
		$fields['shoeSize'] = $profile->shoe_size;
		$fields['jacketSize'] = $profile->jacket_size;
		$fields['trouserWaist'] = $profile->trouser_size;
		$fields['trouserInsideLeg'] = $profile->trouser_inside_leg_size;
		$fields['additionalSizeInfo'] = $profile->extra_info_size;
		$fields['favouriteBrands'] = '';
		$fields['brandsThatFitYouWell'] = $profile->more_brands_size;

		$replacebles = array('£','+');
		$fields['shirtPriceMin'] = str_replace($replacebles, '', $profile->shirt_min_price);
		$fields['shirtPriceMax'] = str_replace($replacebles, '', $profile->shirt_max_price);
		$fields['trouserPriceMin'] = str_replace($replacebles, '', $profile->trouser_min_price);
		$fields['trouserPriceMax'] = str_replace($replacebles, '', $profile->trouser_max_price);
		$fields['coatPriceMin'] = str_replace($replacebles, '', $profile->coat_min_price);
		$fields['coatPriceMax'] = str_replace($replacebles, '', $profile->coat_max_price);
		$fields['shoePriceMin'] = str_replace($replacebles, '', $profile->shoes_min_price);
		$fields['shoePriceMax'] = str_replace($replacebles, '', $profile->shoes_max_price);
		$fields['additionalInfo'] = $profile->extra_price;
		
		

		// section 5 - delivery
		$fields['customerAddressLine1'] = $profile->delivery_add_1;
		$fields['customerAddressLine2'] = ($profile->delivery_add_2)?$profile->delivery_add_2:'';
		$fields['customerTownCity'] = $profile->delivery_town;
		$fields['customerPostCode'] = $profile->delivery_post_code;
		$fields['customerAddressName'] = ($profile->delivery_add_name)?$profile->delivery_add_name:'';;
		$fields['alternativeAddressLine1'] = '';
		$fields['alternativeAddressLine2'] = '';
		$fields['alternativeTownCity'] = '';
		$fields['alternativePostCode'] = '';
		$fields['alternativeAddressName'] = '';
		$fields['billingAddressSameAsCustomerAddress'] = '';
		$fields['billingAddressLine1'] = $profile->bill_add_1;
		$fields['billingAddressLine2'] = ($profile->bill_add_2)? $profile->bill_add_2:'';
		$fields['billingTownCity'] = $profile->bill_town;
		$fields['billingPostCode'] = $profile->bill_post_code;
		$fields['billingAddressName'] = ($profile->bill_add_name)?$profile->bill_add_name:'';
		$fields['deliveryInstructions'] = ($profile->extra_delivery)?$profile->extra_delivery:'';
		$fields['collectionNotes'] = ($profile->extra_collection)?$profile->extra_collection:'';

		//drop off time
		$fields['pageNumber'] = $profile->stage;


		//fields that we dont have
		$fields['contactMeAboutSizing'] = '';
		$fields['commentsToStylist'] = '';
		$fields['termsAndConditionsChecked'] = '';
		$fields['promotionalCode'] = '';
		$fields['giftCardNumber'] = '';
		$fields['websiteRef'] = '';
		$fields['jacketTypeChoices'] = '';
		$fields['whereDoYouWhereYourJacketChoices'] = '';
		$fields['underwearStyleChoices'] = '';
		$fields['styleDislikeDescription'] = '';
		$fields['brandChoices'] = '';


		//fill all fields with something not null
		foreach ($fields as &$value) {
			if (empty($value)){
				$value = '';
			}
		}


		//send it
		$ws_res = $ws->sendForm($fields);
		
		// if it does not say sagepay or its empty its wrong
		$patt = '/\<title\>Sage\sPay/';
		preg_match($patt, $ws_res, $match); 
		if ( empty($match[0]) || empty($ws_res) ){
			debug_log('Something went wrong on the webservices. '); 
		}
		echo "\njust sent {$profile->email}\n";
		
		//mark it as sent in db
		//querying instead of using bespoke update method because that will update the modified field
		//$this->wpdb->query("update {$this->table} set salesforce = 1, ws_sent_date = now()"); 
	}


	public function getSelectedOptions($word, $str){
		$pattern = '/'.$word.'_(\w+)/';
		preg_match_all($pattern, $str, $matches); 
		return $matches[1]; 
	}

	public function getBrands($str){
		$pattern = '/(?!.*_)(\w+)/';
		preg_match_all($pattern, $str, $matches); 
		var_dump($matches); die;
		return $matches[1]; 	
	}

	public function getStageName($num){
		$stage_names = array('details', 'style', 'preferences', 'sizing', 'pricing', 'delivery', 'authorize');
		return $stage_names[$num];
	}

}

$cron = new Cronjobs();
$cron->createSalesforceAccounts(); 

?>
