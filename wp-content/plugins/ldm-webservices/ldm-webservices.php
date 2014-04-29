<?php

/**
*
* Plugin Name: LDM WP Webservices 
* Description: A custom built plugin to provide webservices integration
* Author: Rodrigo Dias
* Author URI: http://likedigitalmedia.com
* Version: 0.1
* Provides: ldm_webservices
*
**/


class ldmwebservices {

	// public $xmlform = '<Message>
	// 	<CustomerID></CustomerID>
	// 	<OrderNumberReference></OrderNumberReference>
	// 	<Email>mike@gmail.com </Email>
	// 	<Password>1</Password>
	// 	<FirstName>PaulAlan</FirstName>
	// 	<LastName>Harvieee</LastName>
	// 	<AddressLine1>74 Park Avenue</AddressLine1>
	// 	<AddressLine2>12 Spring Street</AddressLine2>
	// 	<TownCity>Hull</TownCity>
	// 	<PostCode>HU2 8RD</PostCode>
	// 	<Telephone>07814536328</Telephone>
	// 	<Occupation>software developer</Occupation>
	// 	<DOB>1967-05-10</DOB>
	// 	<BuyingForAnotherPerson>yes</BuyingForAnotherPerson>
	// 	<BuyingForWho>a friend</BuyingForWho>
	// 	<HowDidYouHearAboutEnclothed>Google</HowDidYouHearAboutEnclothed>
	// 	<HowDidYouHearAboutEnclothedOther>someText</HowDidYouHearAboutEnclothedOther>                              
	// 	<StyleChoices>Style1, Style2</StyleChoices>            
	// 	<BrandChoices>brandImage1; brandImage2; brandImage3</BrandChoices>       
	// 	<FavouriteBrands>brand1; brand2; brand3; brand4</FavouriteBrands>                
	// 	<JacketTypeChoices>jacketImage1; jacketImage2</JacketTypeChoices> 
	// 	<WhereDoYouWearYourJacketChoices>work; casual; friday</WhereDoYouWearYourJacketChoices>        
	// 	<ShirtTypeChoice>Slim; Short Sleeve</ShirtTypeChoice> 
	// 	<WhereDoYouWearYourShirtChoices>Casual; Friday; Linen/Holiday</WhereDoYouWearYourShirtChoices>       
	// 	<TrouserTypeChoice> Jeans; Chinos; Formal</TrouserTypeChoice> 
	// 	<TrouserColourChoices>Dark; Neutral</TrouserColourChoices>                    
	// 	<JeanStyleChoice>Bootcut; Straight</JeanStyleChoice>
	// 	<DenimColourChoice>Dark; Medium</DenimColourChoice>        
	// 	<ShortStyleChoice>Short; Above Knee</ShortStyleChoice>
	// 	<ShoeStyleChoices>Trainers; Boots; Formal; Loafers</ShoeStyleChoices>         
	// 	<ShoeColourChoices>Neutral; Dark </ShoeColourChoices>
	// 	<UnderwearStyleChoices>Shorts</UnderwearStyleChoices>
	// 	<StyleDislikeDescription>tight styles with holes</StyleDislikeDescription>
	// 	<TShirtSize>M</TShirtSize>
	// 	<NeckSize>16</NeckSize>
	// 	<SleeveLength>Reg</SleeveLength>                   
	// 	<ShoeSize>10</ShoeSize>
	// 	<JacketSize>44</JacketSize>
	// 	<TrouserWaist>34</TrouserWaist>
	// 	<TrouserInsideLeg>34</TrouserInsideLeg>
	// 	<AdditionalSizeInfo>I can also use waist 33</AdditionalSizeInfo>
	// 	<BrandsThatFitYouWell>Guess, Tommy Hilfiger</BrandsThatFitYouWell>
	// 	<ContactMeAboutSizing> true</ContactMeAboutSizing>
	// 	<ShirtPriceMin>30</ShirtPriceMin>
	// 	<ShirtPriceMax>60</ShirtPriceMax>
	// 	<TrouserPriceMin>25</TrouserPriceMin>
	// 	<TrouserPriceMax>70</TrouserPriceMax>
	// 	<CoatPriceMin>55</CoatPriceMin>
	// 	<CoatPriceMax>180</CoatPriceMax>
	// 	<ShoePriceMin>25</ShoePriceMin>
	// 	<ShoePriceMax>90</ShoePriceMax>  
	// 	<AdditionalInfo>something</AdditionalInfo>
	// 	<CustomerAddressLine1>Apt 41</CustomerAddressLine1>
	// 	<CustomerAddressLine2>12 Spring Street</CustomerAddressLine2>
	// 	<CustomerTownCity>Hull</CustomerTownCity>
	// 	<CustomerPostCode>HU2 8RD</CustomerPostCode>    
	// 	<CustomerAddressName>sdcsdcdczc</CustomerAddressName>
	// 	<AlternativeAddressLine1>Apt 41</AlternativeAddressLine1>
	// 	<AlternativeAddressLine2>12 Spring Street</AlternativeAddressLine2>
	// 	<AlternativeTownCity>Hull</AlternativeTownCity>
	// 	<AlternativePostCode>HU2 8RD</AlternativePostCode>        
	// 	<AlternativeAddressName>sdxvvxcvx</AlternativeAddressName>           
	// 	<BillingAddressSameAsCustomerAddress>true</BillingAddressSameAsCustomerAddress>          
	// 	<BillingAddressLine1>Apt 41</BillingAddressLine1>
	// 	<BillingAddressLine2>12 Spring Street</BillingAddressLine2>
	// 	<BillingTownCity>Hull</BillingTownCity>
	// 	<BillingPostCode>HU2 8RD</BillingPostCode>    
	// 	<BillingAddressName>adsczczczc</BillingAddressName>   
	// 	<DeliveryInstructions>ccxcxcvx</DeliveryInstructions>
	// 	<CollectionNotes>zxczxczxc</CollectionNotes>
	// 	<CommentsToStylist>zxczxcz</CommentsToStylist>
	// 	<TermsAndConditions>true</TermsAndConditions>
	// 	<PromotionalCode>A1234BC</PromotionalCode>
	// 	<GiftCardNumber>Rtr45trz</GiftCardNumber>
	// 	<PageNumber>2</PageNumber>
	// 	<WebsiteRef>ggtt3452hgj</WebsiteRef>
	// 	<ForceLead>false</ForceLead>
	// </Message>';

	public $xmlform = '<Message>
		<customerId></customerId>
		<orderReferenceNumber></orderReferenceNumber>
		<email>paul@gmail-yahoo.com</email>
		<password>1312</password>
		<firstName>Bob</firstName>
		<lastName>Warnold</lastName>
		<addressLine1>apt 41</addressLine1>
		<addressLine2>12 Spring Street</addressLine2>
		<townCity>Hull</townCity>
		<postcode>HU28RD</postcode>
		<telephone>02081234567</telephone>
		<occupation>softwaredeveloper</occupation>
		<dob>1980-02-03</dob>
		<isBuyingForPerson></isBuyingForPerson>
		<buyingForWho></buyingForWho>
		<howDidYouHearAboutEnclothed></howDidYouHearAboutEnclothed>
		<howDidYouHearAboutEnclothedOther></howDidYouHearAboutEnclothedOther>                              
		<styleChoices></styleChoices>            
		<brandChoices></brandChoices>       
		<FavouriteBrands></FavouriteBrands>                
		<jacketTypeChoices></jacketTypeChoices> 
		<whereDoYouWhereYourJacketChoices></whereDoYouWhereYourJacketChoices>        
		<shirtTypeChoice></shirtTypeChoice> 
		<whereDoYouWearYourShirtChoices></whereDoYouWearYourShirtChoices>       
		<trouserTypeChoice></trouserTypeChoice> 
		<trouserColourChoices></trouserColourChoices>                    
		<jeanStyleChoice></jeanStyleChoice>
		<denimColourChoice></denimColourChoice>        
		<shortStyleChoice></shortStyleChoice>
		<shoeStyleChoices></shoeStyleChoices>         
		<shoeColourChoices></shoeColourChoices>
		<underwearStyleChoices></underwearStyleChoices>
		<styleDislikeDescription></styleDislikeDescription>
		<tShirtSize></tShirtSize>
		<neckSize></neckSize>
		<sleeveLength></sleeveLength>                   
		<shoeSize></shoeSize>
		<jacketSize></jacketSize>
		<trouserWaist></trouserWaist>
		<trouserInsideLeg></trouserInsideLeg>
		<additionalSizeInfo></additionalSizeInfo>
		<brandsThatFitYouWell></brandsThatFitYouWell>
		<favouriteBrands></favouriteBrands>
		<contactMeAboutSizing></contactMeAboutSizing>
		<shirtPriceMin></shirtPriceMin>
		<shirtPriceMax></shirtPriceMax>
		<trouserPriceMin></trouserPriceMin>
		<trouserPriceMax></trouserPriceMax>
		<coatPriceMin></coatPriceMin>
		<coatPriceMax></coatPriceMax>
		<shoePriceMin></shoePriceMin>
		<shoePriceMax></shoePriceMax>  
		<additionalInfo></additionalInfo>
		<customerAddressLine1></customerAddressLine1>
		<customerAddressLine2></customerAddressLine2>
		<customerTownCity></customerTownCity>
		<customerPostCode></customerPostCode>    
		<customerAddressName></customerAddressName>
		<alternativeAddressLine1></alternativeAddressLine1>
		<alternativeAddressLine2></alternativeAddressLine2>
		<alternativeTownCity></alternativeTownCity>
		<alternativePostCode></alternativePostCode>        
		<alternativeAddressName></alternativeAddressName>           
		<billingAddressSameAsCustomerAddress></billingAddressSameAsCustomerAddress>          
		<billingAddressLine1></billingAddressLine1>
		<billingAddressLine2></billingAddressLine2>
		<billingTownCity></billingTownCity>
		<billingPostCode></billingPostCode>    
		<billingAddressName></billingAddressName>   
		<deliveryInstructions></deliveryInstructions>
		<collectionNotes></collectionNotes>
		<commentsToStylist></commentsToStylist>
		<termsAndConditionsChecked></termsAndConditionsChecked>
		<promotionalCode></promotionalCode>
		<giftCardNumber></giftCardNumber>
		<pageNumber></pageNumber>
		<websiteRef></websiteRef>
		<forceLead></forceLead>
	</Message>';

public $fields = array(
	'CustomerID',
	'OrderReferenceNumber',
	'Email',
	'Password',
	'FirstName',
	'LastName',
	'AddressLine1',
	'AddressLine2',
	'TownCity',
	'PostCode',
	'Telephone',
	'Occupation',
	'DOB',
	'BuyingForAnotherPerson',
	'BuyingForWho',
	'HowDidYouHearAboutEnclothed',
	'HowDidYouHearAboutEnclothedOther',
	'StyleChoices',
	'BrandChoices',
	'FavouriteBrands',
	'JacketTypeChoices',
	'WhereDoYouWearYourJacketChoices',
	'ShirtTypeChoice',
	'WhereDoYouWearYourShirtChoices',
	'TrouserTypeChoice',
	'TrouserColourChoices',
	'JeanStyleChoice',
	'DenimColourChoice',
	'ShortStyleChoice',
	'ShoeStyleChoices',
	'ShoeColourChoices',
	'UnderwearStyleChoices',
	'StyleDislikeDescription',
	'TShirtSize',
	'NeckSize',
	'SleeveLength',
	'ShoeSize',
	'JacketSize',
	'TrouserWaist',
	'TrouserInsideLeg',
	'AdditionalSizeInfo',
	'BrandsThatFitYouWell',
	'ContactMeAboutSizing',
	'ShirtPriceMin',
	'ShirtPriceMax',
	'TrouserPriceMin',
	'TrouserPriceMax',
	'CoatPriceMin',
	'CoatPriceMax',
	'ShoePriceMin',
	'ShoePriceMax',
	'AdditionalInfo',
	'CustomerAddressLine1',
	'CustomerAddressLine2',
	'CustomerTownCity',
	'CustomerPostCode',
	'CustomerAddressName',
	'AlternativeAddressLine1',
	'AlternativeAddressLine2',
	'AlternativeTownCity',
	'AlternativePostCode',
	'AlternativeAddressName',
	'BillingAddressSameAsCustomerAddress',
	'BillingAddressLine1',
	'BillingAddressLine2',
	'BillingTownCity',
	'BillingPostCode',
	'BillingAddressName',
	'DeliveryInstructions',
	'CollectionNotes',
	'CommentsToStylist',
	'TermsAndConditions',
	'PromotionalCode',
	'GiftCardNumber',
	'PageNumber',
	'WebsiteRef',
	'ForceLead',
	);


public $get = 'https://www.income-systemsltd.com/test%20apps/enclothed/registercustomer.aspx?customerId=&orderReferenceNumber=&email=paul@gmail-yahoo.com&password=1312&firstName=Sally&lastName=Warnold&addressLine1=apt 41&addressLine2=12 Spring Street&townCity=Hull&postcode=HU28RD&telephone=02081234567&occupation=softwaredeveloper&dob=1980-02-03&isBuyingForPerson=&buyingForWho=&howDidYouHearAboutEnclothed=&howDidYouHearAboutEnclothedOther=&styleChoices=&brandChoices=&jacketTypeChoices=&whereDoYouWhereYourJacketChoices=&shirtTypeChoice=&whereDoYouWearYourShirtChoices=&trouserTypeChoice=&trouserColourChoices=&jeanStyleChoice=&denimColourChoice=&shortStyleChoice=&shoeStyleChoices=&shoeColourChoices=&underwearStyleChoices=&styleDislikeDescription=&tShirtSize=&neckSize=&sleeveLength=&shoeSize=&jacketSize=&trouserWaist=&trouserInsideLeg=&additionalSizeInfo=&brandsThatFitYouWell=&favouriteBrands=&contactMeAboutSizing=&shirtPriceMin=&shirtPriceMax=&trouserPriceMin=&trouserPriceMax=&coatPriceMin=&coatPriceMax=&shoePriceMin=&shoePriceMax=&additionalInfo=&customerAddressLine1=&customerAddressLine2=&customerTownCity=&customerPostCode=&customerAddressName=&alternativeAddressLine1=&alternativeAddressLine2=&alternativeTownCity=&alternativePostCode=&alternativeAddressName=&billingAddressSameAsCustomerAddress=&billingAddressLine1=&billingAddressLine2=&billingTownCity=&billingPostCode=&billingAddressName=&deliveryInstructions=&collectionNotes=&commentsToStylist=&termsAndConditionsChecked=&promotionalCode=&giftCardNumber=&pageNumber=&websiteRef=gsdfgsdf35324&forceLead=false';

public function __construct(){
		// $t = file_get_contents($this->get); 
		// var_dump($t); die;
}



public function getForm(){
		// include_once 'form-index.php';
	return $this->form;
}


public function renderFullForm(){
	include_once 'form-index.php';
}

public function sendForm($fields){
	
	$data = $fields;
	// $data['howDidYouHearAboutEnclothed'] = 'default';
	// $data['howDidYouHearAboutEnclothedOther'] = 'howdidyouhearaboutenclothed';
	// $data['isBuyingForPerson'] = 'default';
	// $data['buyingForWho'] = 'forwho';
	// $data['styleChoices'] = '1-1-1';
	// $data['shirtTypeChoice'] ='1-1-3';
	// $data['whereDoYouWearYourShirtChoices'] = 'work';
	// $data['trouserTypeChoice'] = 'jeans';
	// $data['trouserColourChoices'] = 'bright';
	// $data['jeanStyleChoice'] = 'skinny';
	// $data['denimColourChoice'] = 'light';
	// $data['shortStyleChoice'] = 'below-knee';
	// $data['shoeStyleChoices'] = 'boots';
	// $data['shoeColourChoices'] = 'bright';
	// $data['tShirtSize'] = 'XL';
	// $data['neckSize'] = '16';
	// $data['sleeveLength'] = 'bright';
	// $data['shoeSize'] = 'UK12';
	// $data['jacketSize'] = '48';
	// $data['trouserWaist'] = '31';
	// $data['trouserInsideLeg'] = '28';
	// $data['additionalSizeInfo'] = 	'im-a-little-bigger-in-boss-jeans';
	// $data['favouriteBrands'] = 'My-favorite-brand-is-tommy-hillfige';
	// $data['brandsThatFitYouWell'] = 'boss-fits-me-great';
	// $data['contactMeAboutSizing'] = 'true';
	// $data['shirtPriceMin'] = '100';
	// $data['shirtPriceMax'] = '150';
	// $data['trouserPriceMin'] = '100';
	// $data['trouserPriceMax'] = '150';
	// $data['coatPriceMin'] = '200';
	// $data['coatPriceMax'] = '250';
	// $data['shoePriceMin'] = '200';
	// $data['shoePriceMax'] = '250';
	// $data['additionalInfo'] = 'noadditonalinfo';
	// $data['customerAddressLine1'] = 'cust-address-line-1';
	// $data['customerAddressLine2'] = 'cust-address-line-2';
	// $data['customerTownCity'] = 'cust-town_test';
	// $data['customerPostCode'] = 'e16ql';
	// $data['customerAddressName'] = 'cust-name-this-address-alt-address';
	// $data['alternativeAddressLine1'] = 'alt-address-line-1';
	// $data['alternativeAddressLine2'] = 'alt-2';
	// $data['alternativeTownCity'] = 'alttown_test';
	// $data['alternativePostCode'] = 'e16ql';
	// $data['alternativeAddressName'] = 'namethisaddressaltaddress';
	// $data['billingAddressSameAsCustomerAddress'] = 'true';
	// $data['billingAddressLine1'] = 'billaddressline1';
	// $data['billingAddressLine2'] = 'billaddressline2';
	// $data['billingTownCity'] = 'billtown_test';
	// $data['billingPostCode'] = 'e16ql';
	// $data['billingAddressName'] = 'namethisaddressbillingaddress';
	// $data['deliveryInstructions'] = 'del-instructions';
	// $data['collectionNotes'] = 'collection-instructions';
	// $data['commentsToStylist'] = 'Comments-to-stylist';
	// $data['termsAndConditionsChecked'] = 'true';
	// $data['promotionalCode'] = 'promocode';
	// $data['giftCardNumber'] = 'giftcardtest';
	// $data['pageNumber'] = '01';
	// $data['websiteRef'] = 'f3826563928';
	// $data['jacketTypeChoices'] = 'notused';
	// $data['whereDoYouWhereYourJacketChoices'] = 'notused';
	// $data['underwearStyleChoices'] = 'notused';
	// $data['styleDislikeDescription'] = 'notused';
	// $data['brandChoices'] = 'notused';

	// $data['howDidYouHearAboutEnclothed'] = '';
	// $data['howDidYouHearAboutEnclothedOther'] = '';
	// $data['isBuyingForPerson'] = '';
	// $data['buyingForWho'] = '';
	// $data['styleChoices'] = '1-1-';
	// $data['shirtTypeChoice'] ='1-1-';
	// $data['whereDoYouWearYourShirtChoices'] = '';
	// $data['trouserTypeChoice'] = '';
	// $data['trouserColourChoices'] = '';
	// $data['jeanStyleChoice'] = '';
	// $data['denimColourChoice'] = '';
	// $data['shortStyleChoice'] = '';
	// $data['shoeStyleChoices'] = '';
	// $data['shoeColourChoices'] = '';
	// $data['tShirtSize'] = '';
	// $data['neckSize'] = '';
	// $data['sleeveLength'] = '';
	// $data['shoeSize'] = '';
	// $data['jacketSize'] = '';
	// $data['trouserWaist'] = '';
	// $data['trouserInsideLeg'] = '';
	// $data['additionalSizeInfo'] = 	'';
	// $data['favouriteBrands'] = '';
	// $data['brandsThatFitYouWell'] = '';
	// $data['contactMeAboutSizing'] = '';
	// $data['shirtPriceMin'] = '';
	// $data['shirtPriceMax'] = '';
	// $data['trouserPriceMin'] = '';
	// $data['trouserPriceMax'] = '';
	// $data['coatPriceMin'] = '';
	// $data['coatPriceMax'] = '';
	// $data['shoePriceMin'] = '';
	// $data['shoePriceMax'] = '';
	// $data['additionalInfo'] = '';
	// $data['customerAddressLine1'] = '';
	// $data['customerAddressLine2'] = '';
	// $data['customerTownCity'] = '';
	// $data['customerPostCode'] = '';
	// $data['customerAddressName'] = '';
	// $data['alternativeAddressLine1'] = '';
	// $data['alternativeAddressLine2'] = '';
	// $data['alternativeTownCity'] = '';
	// $data['alternativePostCode'] = '';
	// $data['alternativeAddressName'] = '';
	// $data['billingAddressSameAsCustomerAddress'] = '';
	// $data['billingAddressLine1'] = '';
	// $data['billingAddressLine2'] = '';
	// $data['billingTownCity'] = '';
	// $data['billingPostCode'] = '';
	// $data['billingAddressName'] = '';
	// $data['deliveryInstructions'] = '';
	// $data['collectionNotes'] = '';
	// $data['commentsToStylist'] = '';
	// $data['termsAndConditionsChecked'] = '';
	// $data['promotionalCode'] = '';
	// $data['giftCardNumber'] = '';
	// $data['pageNumber'] = '';
	// $data['websiteRef'] = '';
	// $data['jacketTypeChoices'] = '';
	// $data['whereDoYouWhereYourJacketChoices'] = '';
	// $data['underwearStyleChoices'] = '';
	// $data['styleDislikeDescription'] = '';
	// $data['brandChoices'] = '';

	// use key 'http' even if you send the request to https://...
	$url = 'https://www.income-systemsltd.com/test%20apps/enclothed/registercustomer.aspx';
	// $options = array(
	// 	'http' => array(
	// 		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	// 		'method'  => 'POST',
	// 		'content' => http_build_query($data),
	// 		'follow_location' => true,
	// 		),
	// 	);
	// $context  = stream_context_create($options);

	$options = array(
		CURLOPT_RETURNTRANSFER 	=> true,     // return web page
		CURLOPT_HEADER         	=> false,    // don't return headers
		CURLOPT_ENCODING       	=> "",       // handle all encodings
		CURLOPT_USERAGENT      	=> "spider", // who am i
		CURLOPT_AUTOREFERER    	=> true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT 	=> 120,      // timeout on connect
		CURLOPT_TIMEOUT        	=> 120,      // timeout on response
		CURLOPT_MAXREDIRS      	=> 10,       // stop after 10 redirects
		CURLOPT_FOLLOWLOCATION 	=> true,     // follow redirects
		CURLOPT_SSL_VERIFYPEER 	=> false,
		CURLOPT_POST 			=> 1, 
		CURLOPT_POSTFIELDS 		=> http_build_query($data),
	);
	
	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch ); //EXECUTE
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	//if a field is missing - blank string response
	//if a field is worng - redirect to thank you page
	//if all good - redirect to form

	return $content;
}


public function getCustomForm($fields){
	// $form = ' name="enclothed_test" action="https://www.income-systemsltd.com/test apps/enclothed/registercustomer.aspx?" method="POST">';
	$form = '<form name="enclothed_test" action="" method="POST">';
	foreach ($fields as $key => $value) {
		$form .= '<input type="text" name="'.$key.'" value="'.$value.'">'; 
	}

	$form .= file_get_contents(dirname(__FILE__).'/rest_of_form.php');
	return $form;
}

public function renderSageForm() {
	//Create array from xml document
	$SimpleXMLToArray = json_decode(json_encode((array)simplexml_load_string($this->xmlform)),1);
	
	//Instantiate array and strings					
	$sessionArray = array();
	$brandChoices = "";
	$jacketTypeChoices = "";
	$whereDoYouWhereYourJacketChoices = "";
	$shirtTypeChoice = "";
	$whereDoYouWearYourShirtChoices = "";
	$trouserTypeChoice = "";
	$trouserColourChoices = "";
	$jeanStyleChoice = "";
	$denimColourChoice = "";
	$shortStyleChoice = "";
	$shoeStyleChoices = "";
	$shoeColourChoices = "";
	$underwearStyleChoices = "";

	foreach($_SESSION as $sessionParent) {
		foreach($sessionParent as $Key => $Value) {
			$sessionArray[$Key] = $Value;
		}
	}

	//Create array from preferences fields
	$styleChoices = explode(',', $sessionArray['preferences']);

	//Instantiate keys in array
	$styleChoicesArray = array();
	$styleChoicesArray['shirtTypeChoice'] = "";
	$styleChoicesArray['whereDoYouWearYourShirtChoices'] = "";
	$styleChoicesArray['trouserTypeChoice'] = "";
	$styleChoicesArray['trouserColourChoices'] = "";
	$styleChoicesArray['jeanStyleChoice'] = "";
	$styleChoicesArray['denimColourChoice'] = "";
	$styleChoicesArray['shortStyleChoice'] = "";
	$styleChoicesArray['shoeStyleChoices'] = "";
	$styleChoicesArray['shoeColourChoices'] = "";

	//Add brands from Session field by keyname into strings available to pass via input
	foreach($styleChoices as $styleChoice) {
		if (strpos($styleChoice, 'shirt_type_') !== FALSE) {
			$styleChoicesArray['shirtTypeChoice'] .= $styleChoice . ",";
		} else if (strpos($styleChoice, 'shirt_wear_') !== FALSE) {
			$styleChoicesArray['whereDoYouWearYourShirtChoices'] .= $styleChoice . ",";
		} else if (strpos($styleChoice, 'trouser_type_') !== FALSE) {
			$styleChoicesArray['trouserTypeChoice'] .= $styleChoice . ",";
		} else if (strpos($styleChoice, 'trouser_colour_') !== FALSE) {
			$styleChoicesArray['trouserColourChoices'] .= $styleChoice . ",";
		} else if (strpos($styleChoice, 'denim_type_') !== FALSE) {
			$styleChoicesArray['jeanStyleChoice'] .= $styleChoice . ",";
		} else if (strpos($styleChoice, 'denim_colours_') !== FALSE) {
			$styleChoicesArray['denimColourChoice'] .= $styleChoice . ",";
		} else if (strpos($styleChoice, 'shorts_size_') !== FALSE) {
			$styleChoicesArray['shortStyleChoice'] .= $styleChoice . ",";
		} else if (strpos($styleChoice, 'shoe_type_') !== FALSE) {
			$styleChoicesArray['shoeStyleChoices'] .= $styleChoice . ",";
		} else if (strpos($styleChoice, 'colour_shoes_') !== FALSE) {
			$styleChoicesArray['shoeColourChoices'] .= $styleChoice . ",";
		}
	}

	//Trim trailing , from the list of items in string
	$styleChoicesArray['shirtTypeChoice'] = rtrim($styleChoicesArray['shirtTypeChoice'], ",");
	$styleChoicesArray['whereDoYouWearYourShirtChoices'] = rtrim($styleChoicesArray['whereDoYouWearYourShirtChoices'], ",");
	$styleChoicesArray['trouserTypeChoice'] = rtrim($styleChoicesArray['trouserTypeChoice'], ",");
	$styleChoicesArray['trouserColourChoices'] = rtrim($styleChoicesArray['trouserColourChoices'], ",");
	$styleChoicesArray['jeanStyleChoice'] = rtrim($styleChoicesArray['jeanStyleChoice'], ",");
	$styleChoicesArray['denimColourChoice'] = rtrim($styleChoicesArray['denimColourChoice'], ",");
	$styleChoicesArray['shortStyleChoice'] = rtrim($styleChoicesArray['shortStyleChoice'], ",");
	$styleChoicesArray['shoeStyleChoices'] = rtrim($styleChoicesArray['shoeStyleChoices'], ",");
	$styleChoicesArray['shoeColourChoices'] = rtrim($styleChoicesArray['shoeColourChoices'], ",");

	//Comparison array to match keys from session to keys required to pass to sagepay
	$comparisonArray = array();
	$comparisonArray['email'] = 'email';
	$comparisonArray['password'] = 'password';
	$comparisonArray['name'] = 'custom';
	$comparisonArray['addressLine1'] = 'delivery_add_1';
	$comparisonArray['addressLine2'] = 'delivery_add_2';
	$comparisonArray['townCity'] = 'town';
	$comparisonArray['postcode'] = 'post_code';
	$comparisonArray['telephone'] = 'phone';
	$comparisonArray['occupation'] = 'occupation';
	$comparisonArray['dob'] = 'dob';
	$comparisonArray['isBuyingForPerson'] = 'other_person';
	$comparisonArray['buyingForWho'] = 'purchasing_yes';
	$comparisonArray['howDidYouHearAboutEnclothed'] = 'feedback_1';
	$comparisonArray['howDidYouHearAboutEnclothedOther'] = 'how_hear_other';
	$comparisonArray['styleChoices'] = 'styles';
	$comparisonArray['brandChoices'] = 'brands';

	//Below doesn't exist in session array
	$comparisonArray['jacketTypeChoices'] = 'custom';
	$comparisonArray['whereDoYouWhereYourJacketChoices'] = 'custom';


	$comparisonArray['shirtTypeChoice'] = 'custom';
	$comparisonArray['whereDoYouWearYourShirtChoices'] = 'custom';
	$comparisonArray['trouserTypeChoice'] = 'custom';
	$comparisonArray['trouserColourChoices'] = 'custom';
	$comparisonArray['jeanStyleChoice'] = 'custom';
	$comparisonArray['denimColourChoice'] = 'custom';
	$comparisonArray['shortStyleChoice'] = 'custom';
	$comparisonArray['shoeStyleChoices'] = 'custom';
	$comparisonArray['shoeColourChoices'] = 'custom';

	//Below doesn't exist in session array
	$comparisonArray['underwearStyleChoices'] = 'dob';
	$comparisonArray['styleDislikeDescription'] = 'dob';

	$comparisonArray['tShirtSize'] = 'tshirt_size';
	$comparisonArray['neckSize'] = 'neck_size';
	$comparisonArray['sleeveLength'] = 'sleeve_lenght';
	$comparisonArray['shoeSize'] = 'shoe_size';
	$comparisonArray['jacketSize'] = 'jacket_size';
	$comparisonArray['trouserWaist'] = 'trouser_size';
	$comparisonArray['trouserInsideLeg'] = 'trouser_inside_leg_size';
	$comparisonArray['additionalSizeInfo'] = 'extra_info_size';
	$comparisonArray['brandsThatFitYouWell'] = 'more_brands';
	$comparisonArray['favouriteBrands'] = 'more_brands_size';

	//Below doesn't exist in session array
	$comparisonArray['contactMeAboutSizing'] = 'contactMeAboutSizing';

	$comparisonArray['shirtPriceMin'] = 'shirt_min_price';
	$comparisonArray['shirtPriceMax'] = 'shirt_max_price';
	$comparisonArray['trouserPriceMin'] = 'trouser_min_price';
	$comparisonArray['trouserPriceMax'] = 'trouser_max_price';
	$comparisonArray['coatPriceMin'] = 'coat_min_price';
	$comparisonArray['coatPriceMax'] = 'coat_max_price';
	$comparisonArray['shoePriceMin'] = 'shoes_min_price';
	$comparisonArray['shoePriceMax'] = 'shoes_max_price';
	$comparisonArray['additionalInfo'] = 'extra_price';
	$comparisonArray['customerAddressLine1'] = 'delivery_add_1';
	$comparisonArray['customerAddressLine2'] = 'delivery_add_2';
	$comparisonArray['customerTownCity'] = 'delivery_town';
	$comparisonArray['customerPostCode'] = 'delivery_post_code';
	$comparisonArray['customerAddressName'] = 'delivery_add_name';

	//Below doesn't exist in session array
	$comparisonArray['alternativeAddressLine1'] = 'alternativeAddressLine1';
	$comparisonArray['alternativeAddressLine2'] = 'dob';
	$comparisonArray['alternativeTownCity'] = 'dob';
	$comparisonArray['alternativePostCode'] = 'dob';
	$comparisonArray['alternativeAddressName'] = 'dob';

	$comparisonArray['billingAddressSameAsCustomerAddress'] = '';
	$comparisonArray['billingAddressLine1'] = 'bill_add_1';
	$comparisonArray['billingAddressLine2'] = 'bill_add_2';
	$comparisonArray['billingTownCity'] = 'bill_town';
	$comparisonArray['billingPostCode'] = 'bill_post_code';
	$comparisonArray['billingAddressName'] = 'delivery_add_name';
	$comparisonArray['deliveryInstructions'] = 'extra_delivery';
	$comparisonArray['collectionNotes'] = 'extra_collection';

	//Below doesn't exist in session array
	$comparisonArray['commentsToStylist'] = 'commentsToStylist';
	$comparisonArray['termsAndConditionsChecked'] = 'termsAndConditionsChecked';
	$comparisonArray['promotionalCode'] = 'promotionalCode';
	$comparisonArray['giftCardNumber'] = 'giftCardNumber';
	$comparisonArray['pageNumber'] = 'pageNumber';
	$comparisonArray['forceLead'] = 'forceLead'; 

	//Extract first and last name from single name field
	$name = explode(' ',$sessionArray['name']);
	$nameCount = 0;

	//Instantiate output string
	$finalOutput = "";

	//Loop over array and compare with comparison array plus a few extra differences to match a key and value
	foreach($SimpleXMLToArray as $Key => $Value){ 
		$finalValue = $Value;
		$finalKey = $Key;
		if ($finalKey == 'firstName' || $finalKey == 'lastName') {
			//Name case
			$finalValue = $name[$nameCount];
			$nameCount++;
		} else if ($finalKey == "forceLead") {
			//forceLead case
			$finalValue = "false";
		} else if(array_key_exists($Key, $comparisonArray)) {

			$newKey = $comparisonArray[$finalKey];
			if ($newKey == "custom") {
				//If custom means it is in one of preferences arrays
				if(array_key_exists($finalKey, $styleChoicesArray)) {
					$finalValue = $styleChoicesArray[$finalKey];
				} else {
					$finalValue = "";
				}
			} else {
				//If not in session assign no value
				if(array_key_exists($newKey, $sessionArray)) {
					$finalValue = $sessionArray[$newKey];
				} else {
					$finalValue = "";
				}
			}

		}
		//If array means no value
		if(is_array($finalValue)){$finalValue = "";}

		$finalValue = str_replace('+', '',str_replace('£', '', $finalValue));

		$finalOutput .= '<input type="hidden" value="'.$finalValue.'" name="'.$finalKey.'" id="'.$finalKey.'">';
	
	}

	return $finalOutput;
}



}

