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

	public $xmlform = '<Message>
		<CustomerID>1</CustomerID>
		<OrderNumberReference>1</OrderNumberReference>
		<Email>mike@gmail.com </Email>
		<Password>1</Password>
		<FirstName>PaulAlan</FirstName>
		<LastName>Harvieee</LastName>
		<AddressLine1>74 Park Avenue</AddressLine1>
		<AddressLine2>12 Spring Street</AddressLine2>
		<TownCity>Hull</TownCity>
		<PostCode>HU2 8RD</PostCode>
		<Telephone>07814536328</Telephone>
		<Occupation>software developer</Occupation>
		<DOB>1967-05-10</DOB>
		<BuyingForAnotherPerson>yes</BuyingForAnotherPerson>
		<BuyingForWho>a friend</BuyingForWho>
		<HowDidYouHearAboutEnclothed>Google</HowDidYouHearAboutEnclothed>
		<HowDidYouHearAboutEnclothedOther>someText</HowDidYouHearAboutEnclothedOther>                              
		<StyleChoices>Style1, Style2</StyleChoices>            
		<BrandChoices>brandImage1; brandImage2; brandImage3</BrandChoices>       
		<FavouriteBrands>brand1; brand2; brand3; brand4</FavouriteBrands>                
		<JacketTypeChoices>jacketImage1; jacketImage2</JacketTypeChoices> 
		<WhereDoYouWearYourJacketChoices>work; casual; friday</WhereDoYouWearYourJacketChoices>        
		<ShirtTypeChoice>Slim; Short Sleeve</ShirtTypeChoice> 
		<WhereDoYouWearYourShirtChoices>Casual; Friday; Linen/Holiday</WhereDoYouWearYourShirtChoices>       
		<TrouserTypeChoice> Jeans; Chinos; Formal</TrouserTypeChoice> 
		<TrouserColourChoices>Dark; Neutral</TrouserColourChoices>                    
		<JeanStyleChoice>Bootcut; Straight</JeanStyleChoice>
		<DenimColourChoice>Dark; Medium</DenimColourChoice>        
		<ShortStyleChoice>Short; Above Knee</ShortStyleChoice>
		<ShoeStyleChoices>Trainers; Boots; Formal; Loafers</ShoeStyleChoices>         
		<ShoeColourChoices>Neutral; Dark </ShoeColourChoices>
		<UnderwearStyleChoices>Shorts</UnderwearStyleChoices>
		<StyleDislikeDescription>tight styles with holes</StyleDislikeDescription>
		<TShirtSize>M</TShirtSize>
		<NeckSize>16</NeckSize>
		<SleeveLength>Reg</SleeveLength>                   
		<ShoeSize>10</ShoeSize>
		<JacketSize>44</JacketSize>
		<TrouserWaist>34</TrouserWaist>
		<TrouserInsideLeg>34</TrouserInsideLeg>
		<AdditionalSizeInfo>I can also use waist 33</AdditionalSizeInfo>
		<BrandsThatFitYouWell>Guess, Tommy Hilfiger</BrandsThatFitYouWell>
		<ContactMeAboutSizing> true</ContactMeAboutSizing>
		<ShirtPriceMin>30</ShirtPriceMin>
		<ShirtPriceMax>60</ShirtPriceMax>
		<TrouserPriceMin>25</TrouserPriceMin>
		<TrouserPriceMax>70</TrouserPriceMax>
		<CoatPriceMin>55</CoatPriceMin>
		<CoatPriceMax>180</CoatPriceMax>
		<ShoePriceMin>25</ShoePriceMin>
		<ShoePriceMax>90</ShoePriceMax>  
		<AdditionalInfo>something</AdditionalInfo>
		<CustomerAddressLine1>Apt 41</CustomerAddressLine1>
		<CustomerAddressLine2>12 Spring Street</CustomerAddressLine2>
		<CustomerTownCity>Hull</CustomerTownCity>
		<CustomerPostCode>HU2 8RD</CustomerPostCode>    
		<CustomerAddressName>sdcsdcdczc</CustomerAddressName>
		<AlternativeAddressLine1>Apt 41</AlternativeAddressLine1>
		<AlternativeAddressLine2>12 Spring Street</AlternativeAddressLine2>
		<AlternativeTownCity>Hull</AlternativeTownCity>
		<AlternativePostCode>HU2 8RD</AlternativePostCode>        
		<AlternativeAddressName>sdxvvxcvx</AlternativeAddressName>           
		<BillingAddressSameAsCustomerAddress>true</BillingAddressSameAsCustomerAddress>          
		<BillingAddressLine1>Apt 41</BillingAddressLine1>
		<BillingAddressLine2>12 Spring Street</BillingAddressLine2>
		<BillingTownCity>Hull</BillingTownCity>
		<BillingPostCode>HU2 8RD</BillingPostCode>    
		<BillingAddressName>adsczczczc</BillingAddressName>   
		<DeliveryInstructions>ccxcxcvx</DeliveryInstructions>
		<CollectionNotes>zxczxczxc</CollectionNotes>
		<CommentsToStylist>zxczxcz</CommentsToStylist>
		<TermsAndConditions>true</TermsAndConditions>
		<PromotionalCode>A1234BC</PromotionalCode>
		<GiftCardNumber>Rtr45trz</GiftCardNumber>
		<PageNumber>2</PageNumber>
		<WebsiteRef>ggtt3452hgj</WebsiteRef>
		<ForceLead>false</ForceLead>
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
	// $form = '<form name="enclothed_test" action="https://www.income-systemsltd.com/test apps/enclothed/registercustomer.aspx?" method="POST">';
	$form = '<form name="enclothed_test" action="" method="POST">';
	foreach ($fields as $key => $value) {
		$form .= '<input type="text" name="'.$key.'" value="'.$value.'">'; 
	}

	$form .= file_get_contents(dirname(__FILE__).'/rest_of_form.php');
	return $form;
}



}

