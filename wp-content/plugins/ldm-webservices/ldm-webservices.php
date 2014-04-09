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
			'OrderNumberReference',
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
		$t = file_get_contents($this->get); 
		var_dump($t); die;	
	}
	










}

