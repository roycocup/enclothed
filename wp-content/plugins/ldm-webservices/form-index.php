<html>
<head>
	<title>Enclothed form test</title>
</head>

<?


/*$URL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

echo "<font color=red>customerId:</font> ".$_GET['customerId']."<br>"; //int
echo "<font color=red>orderReferenceNumber:</font> ".$_GET['orderReferenceNumber']."<br>"; //int
echo "<font color=red>email:</font> ".$_GET['email']."<br>";
echo "<font color=red>password:</font> ".$_GET['password']."<br>";
echo "<font color=red>firstName:</font> ".$_GET['firstName']."<br>";
echo "<font color=red>lastName:</font> ".$_GET['lastName']."<br>";
echo "<font color=red>addressLine1:</font> ".$_GET['addressLine1']."<br>";
echo "<font color=red>addressLine2:</font> ".$_GET['addressLine2']."<br>";
echo "<font color=red>townCity:</font> ".$_GET['townCity']."<br>";
echo "<font color=red>postcode:</font> ".$_GET['postcode']."<br>"; //char limit 7
echo "<font color=red>telephone:</font> ".$_GET['telephone']."<br>";
echo "<font color=red>occupation:</font> ".$_GET['occupation']."<br>";
echo "<font color=red>dob:</font> ".$_GET['dob']."<br>";
echo "<font color=red>isBuyingForPerson:</font> ".$_GET['isBuyingForPerson']."<br>";
echo "<font color=red>buyingForWho:</font> ".$_GET['buyingForWho']."<br>";
echo "<font color=red>howDidYouHearAboutEnclothed:</font> ".$_GET['howDidYouHearAboutEnclothed']."<br>";
echo "<font color=red>howDidYouHearAboutEnclothedOther:</font> ".$_GET['howDidYouHearAboutEnclothedOther']."<br>";
echo "<font color=red>styleChoices:</font> ".$_GET['styleChoices']."<br>";
echo "<font color=red>jacketTypeChoices:</font> ".$_GET['jacketTypeChoices']."<br>";
echo "<font color=red>whereDoYouWhereYourJacketChoices:</font> ".$_GET['whereDoYouWhereYourJacketChoices']."<br>";
echo "<font color=red>shirtTypeChoice:</font> ".$_GET['shirtTypeChoice']."<br>";
echo "<font color=red>whereDoYouWearYourShirtChoices:</font> ".$_GET['whereDoYouWearYourShirtChoices']."<br>";
echo "<font color=red>trouserTypeChoice:</font> ".$_GET['trouserTypeChoice']."<br>";
echo "<font color=red>trouserColourChoices:</font> ".$_GET['trouserColourChoices']."<br>";
echo "<font color=red>jeanStyleChoice:</font> ".$_GET['jeanStyleChoice']."<br>";
echo "<font color=red>denimColourChoice:</font> ".$_GET['denimColourChoice']."<br>";
echo "<font color=red>shortStyleChoice:</font> ".$_GET['shortStyleChoice']."<br>";
echo "<font color=red>shoeStyleChoices:</font> ".$_GET['shoeStyleChoices']."<br>";
echo "<font color=red>shoeColourChoices:</font> ".$_GET['shoeColourChoices']."<br>";
echo "<font color=red>underwearStyleChoices:</font> ".$_GET['underwearStyleChoices']."<br>";
echo "<font color=red>styleDislikeDescription:</font> ".$_GET['styleDislikeDescription']."<br>";
echo "<font color=red>tShirtSize:</font> ".$_GET['tShirtSize']."<br>";
echo "<font color=red>neckSize:</font> ".$_GET['neckSize']."<br>";
echo "<font color=red>sleeveLength:</font> ".$_GET['sleeveLength']."<br>";
echo "<font color=red>shoeSize:</font> ".$_GET['shoeSize']."<br>";
echo "<font color=red>jacketSize:</font> ".$_GET['jacketSize']."<br>";
echo "<font color=red>trouserWaist:</font> ".$_GET['trouserWaist']."<br>";
echo "<font color=red>trouserInsideLeg:</font> ".$_GET['trouserInsideLeg']."<br>";
echo "<font color=red>additionalSizeInfo:</font> ".$_GET['additionalSizeInfo']."<br>";
echo "<font color=red>brandsThatFitYouWell:</font> ".$_GET['brandsThatFitYouWell']."<br>";
echo "<font color=red>favouriteBrands:</font> ".$_GET['favouriteBrands']."<br>";
echo "<font color=red>contactMeAboutSizing:</font> ".$_GET['contactMeAboutSizing']."<br>";
echo "<font color=red>shirtPriceMin:</font> ".$_GET['shirtPriceMin']."<br>";
echo "<font color=red>shirtPriceMax:</font> ".$_GET['shirtPriceMax']."<br>";
echo "<font color=red>trouserPriceMin:</font> ".$_GET['trouserPriceMin']."<br>";
echo "<font color=red>trouserPriceMax:</font> ".$_GET['trouserPriceMax']."<br>";
echo "<font color=red>coatPriceMin:</font> ".$_GET['coatPriceMin']."<br>";
echo "<font color=red>coatPriceMax:</font> ".$_GET['coatPriceMax']."<br>";
echo "<font color=red>shoePriceMin:</font> ".$_GET['shoePriceMin']."<br>";
echo "<font color=red>shoePriceMax:</font> ".$_GET['shoePriceMax']."<br>";
echo "<font color=red>additionalInfo:</font> ".$_GET['additionalInfo']."<br>";
echo "<font color=red>customerAddressLine1:</font> ".$_GET['customerAddressLine1']."<br>";
echo "<font color=red>customerAddressLine2:</font> ".$_GET['customerAddressLine2']."<br>";
echo "<font color=red>customerTownCity:</font> ".$_GET['customerTownCity']."<br>";
echo "<font color=red>customerPostCode:</font> ".$_GET['customerPostCode']."<br>";
echo "<font color=red>customerAddressName:</font> ".$_GET['customerAddressName']."<br>";
echo "<font color=red>alternativeAddressLine1:</font> ".$_GET['alternativeAddressLine1']."<br>";
echo "<font color=red>alternativeAddressLine2:</font> ".$_GET['alternativeAddressLine2']."<br>";
echo "<font color=red>alternativeTownCity:</font> ".$_GET['alternativeTownCity']."<br>";
echo "<font color=red>alternativePostCode:</font> ".$_GET['alternativePostCode']."<br>";
echo "<font color=red>alternativeAddressName:</font> ".$_GET['alternativeAddressName']."<br>";
echo "<font color=red>billingAddressSameAsCustomerAddress:</font> ".$_GET['billingAddressSameAsCustomerAddress']."<br>"; // 0/1 or true/false
echo "<font color=red>billingAddressLine1:</font> ".$_GET['billingAddressLine1']."<br>";
echo "<font color=red>billingAddressLine2:</font> ".$_GET['billingAddressLine2']."<br>";
echo "<font color=red>billingTownCity:</font> ".$_GET['billingTownCity']."<br>";
echo "<font color=red>billingPostCode:</font> ".$_GET['billingPostCode']."<br>";
echo "<font color=red>billingAddressName:</font> ".$_GET['billingAddressName']."<br>";
echo "<font color=red>deliveryInstructions:</font> ".$_GET['deliveryInstructions']."<br>";
echo "<font color=red>collectionNotes:</font> ".$_GET['collectionNotes']."<br>";
echo "<font color=red>commentsToStylist:</font> ".$_GET['commentsToStylist']."<br>";
echo "<font color=red>termsAndConditionsChecked:</font> ".$_GET['termsAndConditionsChecked']."<br>";
echo "<font color=red>promotionalCode:</font> ".$_GET['promotionalCode']."<br>";
echo "<font color=red>giftCardNumber:</font> ".$_GET['giftCardNumber']."<br>";
echo "<font color=red>pageNumber:</font> ".$_GET['pageNumber']."<br>";
echo "<font color=red>websiteRef:</font> ".$_GET['websiteRef']."<br>";
echo "<font color=red>forceLead:</font> ".$_GET['forceLead']."<br>";
echo "<font color=red>brandChoices:</font> ".$_GET['brandChoices']."<br>";

*/

?>

<body>
	<!-- <form name="enclothed_test" action="<? echo $URL; ?>" method="GET"> -->

	<form name="enclothed_test" action="https://www.income-systemsltd.com/test apps/enclothed/registercustomer.aspx?" method="POST">

		<div align="center">

			<strong>Your Details</strong>


			<p>
				<input type="text" tabindex="1" name="customerId" placeholder="Customer ID" value="98669">
			</p>
			<p>
				<input type="text" tabindex="1" name="orderReferenceNumber" placeholder="Order Reference" value="758775">
			</p>

			<p>
				<input type="text" tabindex="1" name="firstName" placeholder="First name" value="simon">
			</p>

			<p>
				<input type="text" tabindex="1" name="lastName" placeholder="Last Name" value="berry">
			</p>
			<p>
				<input type="text" tabindex="1" name="addressLine1" placeholder="Address 1" value="addressline1">
			</p>
			<p>
				<input type="text" tabindex="1" name="addressLine2" placeholder="Address 2" value="addressline2">
			</p>
			<p>
				<input type="text" tabindex="1" name="townCity" placeholder="Town" value="town_test">
			</p>
			<p>
				<input type="text" tabindex="1" name="email" placeholder="Email" value="test@likedigitalmedia.com">
			</p>
			<p>
				<input type="text" tabindex="1" name="postcode" placeholder="Post code" value="e16ql">
			</p>
			<p>
				<input type="text" tabindex="1" name="telephone" placeholder="Telephone" value="36345643565463">
			</p>
			<p>
				<input type="text" tabindex="1" name="occupation" placeholder="Occupation" value="formtesterextraordinaire">
			</p>
			<p>
				<input type="text" tabindex="1" name="password" placeholder="Password" value="password1">
			</p>
			<p>
				<input type="text" tabindex="1" name="dob" value="1985-03-14">
			</p>



			<select class="selectmenu" tabindex="10" name="howDidYouHearAboutEnclothed" value="hear_default">
				<option value="default">How did you hear about enclothed?</option>
				<option value="The Internet">The Internet</option>
				<option value="Word of Mouth">Word of Mouth</option>
				<option value="A Friend ">A Friend </option>
				<option value="Magazine Advert">Magazine Advert</option>
				<option value="Email Marketing">Email Marketing</option>
				<option value="Magazine Article">Magazine Article</option>
				<option value="Promotional Material">Promotional Material</option>
				<option value="Other">Other</option>
			</select>
			<br><br>

			<strong>Other (from above)</strong><br><br>

			<textarea cols="40" rows="5" name="howDidYouHearAboutEnclothedOther" value="other">
				howdidyouhearaboutenclothed
			</textarea>
			<br><br>

			<select class="selectmenu" tabindex="11" name="isBuyingForPerson" value="default-other">
				<option value="default">Are you purchasing for another person?</option>
				<option value="Yes">Yes</option>
				<option value="No">No</option>
			</select>
			<br><br>

			buying for who?<br><br>
			<p>
				<input type="text" tabindex="1" name="buyingForWho" value="forwho">
			</p>

			<strong>Pick your style</strong><br><br>

			<textarea cols="40" rows="5" name="styleChoices" value="1,1,1">
				1-1-1
			</textarea>
			<br><br>

			<strong>Your Brands</strong><br><br>

			<textarea cols="40" rows="5" name="shirtTypeChoice" value="1,1,1">
				1-1-3
			</textarea>
			<br><br>

			<strong>Shirts</strong><br><br>

			<p>Shirt type choice</strong></p>
			<select multiple  tabindex="11" name="whereDoYouWearYourShirtChoices">

				<option value="slim" selected>slim</option>
				<option value="reg">Reg</option>
				<option value="short">short</option>
			</select><br><br>

			<p>Where do your shirts</p>
			<select multiple tabindex="11" name="whereDoYouWearYourShirtChoices">

				<option value="work" selected>work</option>
				<option value="casual">casual</option>
				<option value="friday">friday</option>
				<option value="holiday/linen">holiday/linen</option>					
			</select><br><br>


			<strong>Trousers</strong><br><br>

			<p>WHAT TROUSERS DO YOU WEAR?</p>
			<select multiple  tabindex="11" name="trouserTypeChoice">

				<option value="jeans" selected>jeans</option>
				<option value="chinos">chinos</option>
				<option value="formal">formal</option>
				<option value="cords">cords</option>	
			</select><br><br>

			<p>WHAT COLOUR TROUSERS DO YOU WEAR?</p>
			<select multiple  tabindex="11" name="trouserColourChoices">

				<option value="bright" selected>bright</option>
				<option value="nuteral">nuteral</option>
				<option value="dark">dark</option>
				<option value="patterned">patterned</option>					
			</select><br><br>


			<strong>Jean style</strong><br><br>

			<p>HOW DO YOU WEAR YOUR JEANS?</p>
			<select multiple  tabindex="11" name="jeanStyleChoice" value="default-jeanschoice">

				<option value="skinny" selected>skinny</option>
				<option value="straight">straight</option>
				<option value="bootcut">bootcut</option>
				<option value="baggy">baggy</option>	
			</select><br><br>

			<p>WHICH COLOURS OF DENIM DO YOU WEAR?</p>
			<select multiple  tabindex="11" name="denimColourChoice" value="default-deminchoice">

				<option value="light" selected>light</option>
				<option value="nmedium">medium</option>
				<option value="dark">dark</option>
				<option value="black">black</option>					
				<option value="coloured">coloured</option>		
			</select><br><br>

			<strong>Short style</strong><br><br>

			<p>HOW DO YOU WEAR YOUR SHORTS?</p>
			<select multiple  tabindex="11" name="shortStyleChoice" value="short-default">
				<option value="below-knee" selected>below knee</option>
				<option value="above knee">above knee</option>
				<option value="short">short</option>
				
			</select><br><br>


			<strong>Shoe Style</strong><br><br>


			<select multiple  tabindex="11" name="shoeStyleChoices" value="default-shoes">
				<option value="boots" selected>boots</option>
				<option value="brogues">brogues</option>
				<option value="trainers">trainers</option>
				<option value="boat shoes">boat shoes</option>
				<option value="loafers">loafers</option>	
				<option value="formal">formal</option>					
			</select><br><br>

			<p>Whats colour shoes?</p>
			<select multiple  tabindex="11" name="shoeColourChoices" value="default-shoes-colour">
				<option value="bright" selected>bright</option>
				<option value="nuteral">nuteral</option>
				<option value="dark">dark</option>
				
			</select><br><br>

			<strong>Size and Colour</strong><br><br>

			<p>
				<input type="text" tabindex="1" name="tShirtSize" value="XL">
			</p>
			<p>
				<input type="text" tabindex="1" name="neckSize" value="16">
			</p>

			<p>Sleeve Lenght?</p>
			<select multiple  tabindex="11" name="sleeveLength">
				<option value="bright" selected>short</option>
				<option value="regular">regular</option>
				<option value="long">long</option>
				
			</select><br><br>

			<p>
				<input type="text" tabindex="1" name="shoeSize" value="UK12">
			</p>

			<p>
				<input type="text" tabindex="1" name="jacketSize" value="48">
			</p>
			<p>
				<input type="text" tabindex="1" name="trouserWaist" value="31">
			</p>

			<p>Trouser inside leg</p>
			<select class="selectmenu" tabindex="10" name="trouserInsideLeg" value="default-inside-leg">
				<option value="28">28</option>
				<option value="30">30</option>
				<option value="32">32</option>
				<option value="34">34</option>
				<option value="36">36</option>
				<option value="short">short</option>
				<option value="reg">reg</option>
				<option value="long">long</option>
			</select>		


			<p>Brands</p>

			<textarea cols="40" rows="5" name="additionalSizeInfo" value="im-a-little-bigger-in-boss-jeans">
				im-a-little-bigger-in-boss-jeans
			</textarea>
			<br><br>

			<p>Favourite Brands</p>

			<textarea cols="40" rows="5" name="favouriteBrands" value="My-favorite-brand-is-tommy-hillfiger">
				My-favorite-brand-is-tommy-hillfige
			</textarea>
			<br><br>

			<p>Brands that fi you well</p>
			<textarea cols="40" rows="5" name="brandsThatFitYouWell" value="boss-fits-me-great">
				boss-fits-me-great
			</textarea>
			<br><br>

			<p>
				Contact me about sizing <input type="text" tabindex="1" name="contactMeAboutSizing" value="true">
			</p>

			<br><br>

			<p><strong>Price and Summary</strong></p>

			<p>
				Shirt price, from <input type="text" tabindex="1" name="shirtPriceMin" value="100">
				to <input type="text" tabindex="1" name="shirtPriceMax" value="150">
			</p>

			<p>
				Trouser price, from <input type="text" tabindex="1" name="trouserPriceMin" value="100">
				to <input type="text" tabindex="1" name="trouserPriceMax" value="150">
			</p>

			<p>
				Coat price, from <input type="text" tabindex="1" name="coatPriceMin" value="200">
				to <input type="text" tabindex="1" name="coatPriceMax" value="250">
			</p>

			<p>
				Shoe price, from <input type="text" tabindex="1" name="shoePriceMin" value="200">
				to <input type="text" tabindex="1" name="shoePriceMax" value="250">
			</p>

			<p>Anything you'd like to add?</p>

			<textarea cols="40" rows="5" name="additionalInfo" value="noadditonalinfo">
				noadditonalinfo
			</textarea>
			<br><br>

			<p><strong>Delivery</strong></p>

			<p>Customer address</p>
			<p>
				<input type="text" tabindex="1" name="customerAddressLine1" placeholder="Address 1" value="cust-address-line-1">
			</p>
			<p>
				<input type="text" tabindex="1" name="customerAddressLine2" placeholder="Address 2" value="cust-address-line-2">
			</p>
			<p>
				<input type="text" tabindex="1" name="customerTownCity" placeholder="Town" value="cust-town_test">
			</p>
			<p>
				<input type="text" tabindex="1" name="customerPostCode" placeholder="Post code" value="e16ql">
			</p>

			<p>
				<input type="text" tabindex="1" name="customerAddressName" placeholder="alt Post code" value="cust-name-this-address-alt-address">
			</p>


			<p>Alternative address</p>
			<p>
				<input type="text" tabindex="1" name="alternativeAddressLine1" placeholder="alt Address 1" value="alt-address-line-1">
			</p>
			<p>
				<input type="text" tabindex="1" name="alternativeAddressLine2" placeholder="alt Address 2" value="alt-2">
			</p>
			<p>
				<input type="text" tabindex="1" name="alternativeTownCity" placeholder="alt Town" value="alttown_test">
			</p>
			<p>
				<input type="text" tabindex="1" name="alternativePostCode" placeholder="alt Post code" value="e16ql">
			</p>

			<p>
				<input type="text" tabindex="1" name="alternativeAddressName" placeholder="alt Post code" value="namethisaddressaltaddress">
			</p>

			<p>Billing address</p>
			<p>
				Contact me about sizing <input type="text" tabindex="1" name="billingAddressSameAsCustomerAddress" value="true">
			</p>
			<p>
				<input type="text" tabindex="1" name="billingAddressLine1" placeholder="alt Address 1" value="billaddressline1">
			</p>
			<p>
				<input type="text" tabindex="1" name="billingAddressLine2" placeholder="alt Address 2" value="billaddressline2">
			</p>
			<p>
				<input type="text" tabindex="1" name="billingTownCity" placeholder="alt Town" value="billtown_test">
			</p>
			<p>
				<input type="text" tabindex="1" name="billingPostCode" placeholder="alt Post code" value="e16ql">
			</p>

			<p>
				<input type="text" tabindex="1" name="billingAddressName" placeholder="alt Post code" value="namethisaddressbillingaddress">
			</p>


			<p>Any Delivery Instructions?</p>

			<textarea cols="40" rows="5" name="deliveryInstructions" value="deliveryinstructions">
				del-instructions
			</textarea>
			<br><br>

			<p>Collection Notes?</p>

			<textarea cols="40" rows="5" name="collectionNotes" value="CollectionsNotes">
				collection-instructions
			</textarea>
			<br><br>

			<p>Comments to Stylist?</p>

			<textarea cols="40" rows="5" name="commentsToStylist" value="stylistcomments">
				Comments-to-stylist
			</textarea>
			<br><br>


			<p>
				I accept terms and conditons <input type="text" tabindex="1" name="termsAndConditionsChecked" value="true">
			</p>


			<p>Promotions</p>
			<p>
				<input type="text" tabindex="1" name="promotionalCode" value="promocode">
			</p>
			<p>
				<input type="text" tabindex="1" name="giftCardNumber" value="giftcardtest">
			</p>

			<p>Sales force details</p>
			<p>
				<input type="text" tabindex="1" name="pageNumber" value="01"> <!-- where the person drops out -->
			</p>
			<p>
				<input type="text" tabindex="1" name="websiteRef" value="f3826563928">
			</p>


			<p>Force lead</p>
			<select class="selectmenu" tabindex="10" name="forceLead">
				<option value="select">Select</option>
				<option value="true">True</option>
				<option value="false" selected>False</option>
			</select>
			<br><br>


			<p>Unneeded data</p>

			<p>
				<input type="text" tabindex="1" name="jacketTypeChoices" value="notused">
			</p>
			<p>
				<input type="text" tabindex="1" name="whereDoYouWhereYourJacketChoices" value="notused">
			</p>
			<p>
				<input type="text" tabindex="1" name="underwearStyleChoices" value="notused">
			</p>
			<p>
				<input type="text" tabindex="1" name="styleDislikeDescription" value="notused">
			</p>
			<p>
				<input type="text" tabindex="1" name="brandChoices" value="notused">
			</p>




			<input type="submit" value="submit">





			<br><br><br><br><br><br><br><br><br><br>
		</div>
	</form>
</body>
</html>
