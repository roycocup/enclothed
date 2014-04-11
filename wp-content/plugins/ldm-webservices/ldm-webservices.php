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
		<Password> 1 </Password>
		<FirstName>PaulAlan</FirstName>
		<LastName>Harvieee</LastName>
		<AddressLine1>74 Park Avenue </AddressLine1>
		<AddressLine2> 12 Spring Street </AddressLine2>
		<TownCity> Hull</TownCity>
		<PostCode>HU2 8RD </PostCode>
		<Telephone> 07814536328 </Telephone>
		<Occupation> software developer </Occupation>
		<DOB>1967-05-10 </DOB>
		<BuyingForAnotherPerson> yes </BuyingForAnotherPerson>
		<BuyingForWho> a friend </BuyingForWho>
		<HowDidYouHearAboutEnclothed> Google </HowDidYouHearAboutEnclothed>
		<HowDidYouHearAboutEnclothedOther> someText</HowDidYouHearAboutEnclothedOther>                              
		<StyleChoices> Style1, Style2 </StyleChoices>            
		<BrandChoices> brandImage1; brandImage2; brandImage3 </BrandChoices>       
		<FavouriteBrands> brand1; brand2; brand3; brand4 </FavouriteBrands>                
		<JacketTypeChoices> jacketImage1; jacketImage2 </JacketTypeChoices> 
		<WhereDoYouWearYourJacketChoices> work; casual; friday </WhereDoYouWearYourJacketChoices>        
		<ShirtTypeChoice>Slim; Short Sleeve</ShirtTypeChoice> 
		<WhereDoYouWearYourShirtChoices> Casual; Friday; Linen/Holiday </WhereDoYouWearYourShirtChoices>       
		<TrouserTypeChoice> Jeans; Chinos; Formal</TrouserTypeChoice> 
		<TrouserColourChoices> Dark; Neutral </TrouserColourChoices>                    
		<JeanStyleChoice> Bootcut; Straight </JeanStyleChoice>
		<DenimColourChoice> Dark; Medium</DenimColourChoice>        
		<ShortStyleChoice> Short; Above Knee</ShortStyleChoice>
		<ShoeStyleChoices> Trainers; Boots; Formal; Loafers </ShoeStyleChoices>         
		<ShoeColourChoices>Neutral; Dark </ShoeColourChoices>
		<UnderwearStyleChoices> Shorts </UnderwearStyleChoices>
		<StyleDislikeDescription> tight styles with holes </StyleDislikeDescription>
		<TShirtSize>M</TShirtSize>
		<NeckSize>16</NeckSize>
		<SleeveLength>Reg</SleeveLength>                   
		<ShoeSize> 10</ShoeSize>
		<JacketSize> 44</JacketSize>
		<TrouserWaist>34 </TrouserWaist>
		<TrouserInsideLeg>34 </TrouserInsideLeg>
		<AdditionalSizeInfo> I can also use waist 33</AdditionalSizeInfo>
		<BrandsThatFitYouWell> Guess, Tommy Hilfiger</BrandsThatFitYouWell>
		<ContactMeAboutSizing> true</ContactMeAboutSizing>
		<ShirtPriceMin>30 </ShirtPriceMin>
		<ShirtPriceMax>60 </ShirtPriceMax>
		<TrouserPriceMin>25 </TrouserPriceMin>
		<TrouserPriceMax> 70</TrouserPriceMax>
		<CoatPriceMin>55</CoatPriceMin>
		<CoatPriceMax> 180 </CoatPriceMax>
		<ShoePriceMin> 25</ShoePriceMin>
		<ShoePriceMax> 90 </ShoePriceMax>  
		<AdditionalInfo> </AdditionalInfo>
		<CustomerAddressLine1>Apt 41 </CustomerAddressLine1>
		<CustomerAddressLine2> 12 Spring Street </CustomerAddressLine2>
		<CustomerTownCity> Hull</CustomerTownCity>
		<CustomerPostCode>HU2 8RD </CustomerPostCode>    
		<CustomerAddressName> </CustomerAddressName>
		<AlternativeAddressLine1>Apt 41 </AlternativeAddressLine1>
		<AlternativeAddressLine2> 12 Spring Street </AlternativeAddressLine2>
		<AlternativeTownCity> Hull</AlternativeTownCity>
		<AlternativePostCode>HU2 8RD </AlternativePostCode>        
		<AlternativeAddressName> </AlternativeAddressName>           
		<BillingAddressSameAsCustomerAddress>true</BillingAddressSameAsCustomerAddress>          
		<BillingAddressLine1>Apt 41 </BillingAddressLine1>
		<BillingAddressLine2> 12 Spring Street </BillingAddressLine2>
		<BillingTownCity> Hull</BillingTownCity>
		<BillingPostCode>HU2 8RD </BillingPostCode>    
		<BillingAddressName> </BillingAddressName>   
		<DeliveryInstructions> </DeliveryInstructions>
		<CollectionNotes> </CollectionNotes>
		<CommentsToStylist> </CommentsToStylist>
		<TermsAndConditions> true </TermsAndConditions>
		<PromotionalCode>A1234BC </PromotionalCode>
		<GiftCardNumber> Rtr45trz</GiftCardNumber>
		<PageNumber>2</PageNumber>
		<WebsiteRef>ggtt3452hgj</WebsiteRef>
		<ForceLead>false</ForceLead>
	</Message>';

public $form = array(
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
	$data['howDidYouHearAboutEnclothed'] = 'default';
    $data['howDidYouHearAboutEnclothedOther'] = 'howdidyouhearaboutenclothed';
    $data['isBuyingForPerson'] = 'default';
    $data['buyingForWho'] = 'forwho';
    $data['styleChoices'] = '1-1-1';
	$data['shirtTypeChoice'] ='1-1-3';
	$data['whereDoYouWearYourShirtChoices'] = 'work';
    $data['trouserTypeChoice'] = 'jeans';
    $data['trouserColourChoices'] = 'bright';
    $data['jeanStyleChoice'] = 'skinny';
    $data['denimColourChoice'] = 'light';
    $data['shortStyleChoice'] = 'below-knee';
    $data['shoeStyleChoices'] = 'boots';
    $data['shoeColourChoices'] = 'bright';
    $data['tShirtSize'] = 'XL';
    $data['neckSize'] = '16';
    $data['sleeveLength'] = 'bright';
    $data['shoeSize'] = 'UK12';
    $data['jacketSize'] = '48';
    $data['trouserWaist'] = '31';
    $data['trouserInsideLeg'] = '28';
    $data['additionalSizeInfo'] = 	'im-a-little-bigger-in-boss-jeans';
	$data['favouriteBrands'] = 'My-favorite-brand-is-tommy-hillfige';
	$data['brandsThatFitYouWell'] = 'boss-fits-me-great';
	$data['contactMeAboutSizing'] = 'true';
    $data['shirtPriceMin'] = '100';
    $data['shirtPriceMax'] = '150';
    $data['trouserPriceMin'] = '100';
    $data['trouserPriceMax'] = '150';
    $data['coatPriceMin'] = '200';
    $data['coatPriceMax'] = '250';
    $data['shoePriceMin'] = '200';
    $data['shoePriceMax'] = '250';
    $data['additionalInfo'] = 'noadditonalinfo';
	$data['customerAddressLine1'] = 'cust-address-line-1';
    $data['customerAddressLine2'] = 'cust-address-line-2';
    $data['customerTownCity'] = 'cust-town_test';
    $data['customerPostCode'] = 'e16ql';
    $data['customerAddressName'] = 'cust-name-this-address-alt-address';
    $data['alternativeAddressLine1'] = 'alt-address-line-1';
    $data['alternativeAddressLine2'] = 'alt-2';
    $data['alternativeTownCity'] = 'alttown_test';
    $data['alternativePostCode'] = 'e16ql';
    $data['alternativeAddressName'] = 'namethisaddressaltaddress';
    $data['billingAddressSameAsCustomerAddress'] = 'true';
    $data['billingAddressLine1'] = 'billaddressline1';
    $data['billingAddressLine2'] = 'billaddressline2';
    $data['billingTownCity'] = 'billtown_test';
    $data['billingPostCode'] = 'e16ql';
    $data['billingAddressName'] = 'namethisaddressbillingaddress';
    $data['deliveryInstructions'] = 'del-instructions';
	$data['collectionNotes'] = 'collection-instructions';
	$data['commentsToStylist'] = 'Comments-to-stylist';
	$data['termsAndConditionsChecked'] = 'true';
    $data['promotionalCode'] = 'promocode';
    $data['giftCardNumber'] = 'giftcardtest';
    $data['pageNumber'] = '01';
    $data['websiteRef'] = 'f3826563928';
    $data['jacketTypeChoices'] = 'notused';
    $data['whereDoYouWhereYourJacketChoices'] = 'notused';
    $data['underwearStyleChoices'] = 'notused';
    $data['styleDislikeDescription'] = 'notused';
    $data['brandChoices'] = 'notused';

	// use key 'http' even if you send the request to https://...
	$url = 'https://www.income-systemsltd.com/test%20apps/enclothed/registercustomer.aspx';
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
			'follow_location' => true,
			),
		);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	$url_reg = '/href=\"(.*?)"/';
	preg_match($url_reg, $result, $match);

	$sf_form = stream_get_contents($match[1]);

	return $sf_form;
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

