<?php
/**
*
* template name: Profile Details
*
**/

get_header(); ?>

<?php 
if (isset($_SESSION['section_1'])){
	$section = $_SESSION['section_1'];	
}else if(isset($_POST['section_1'])){
	$section = $_POST['section_1'];
} else {
	$section = array();
}


?>


<div class="inner-page-wrap has-no-sidebar clearfix">
	<div class="post-8 page type-page status-publish hentry clearfix" id="8">				
		<div class="page-content clearfix">
			<div class="row">
                <div class="full-width-text spb_content_element col-sm-12 no-padding-top spb_text_column">
                    <div class="spb_wrapper clearfix">
                        <h1 style="text-align: center;"><span style="color: #ffffff;">BUILD YOUR<br>
                        ENCLOTHED PROFILE</span></h1>
                        <p style="margin-bottom: 0;"><img class="size-full aligncenter" alt="line" src="/wp-content/uploads/2014/03/line.png"></p>
					</div> 
                </div>
            </div>
			<div class="row">
				<!-- Main Menu -->
 		<div class="details-menu">
 		<ul>
 			<li><a href="http:/#/">Your Details</a></li>
 			<li><a href="http:/#/">Pick your Style</a></li>
 			<li><a href="http:/#/">Size and Color</a></li>
 			<li><a href="http:/#/">Price and Summary</a></li>
 			<li><a href="http:/#/">Delivery</a></li>
 		</ul>
 <div class="shadow"><img src="img/shadow.png" alt="" /></div>
 </div><!--details-menu-->
  
 	<div class="styles-block">
 	
			<div class="title-forms">
				<div class="mini-wrapper-forms">
		 	  	<div class="numbering">01</div>
		 	  	<p>Some Key Pieces of information we need about you.</p>
		 	  	<input type="text" class="key-info" tabindex="1" value="Full Name" required onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	<input type="text" class="key-info" tabindex="1" value="Post Code" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	<input type="text" class="key-info" tabindex="1" value="Address" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	<input type="text" class="key-info" tabindex="1" value="Phone Number" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	<input type="town" class="key-info" tabindex="1" value="Town/City" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	<input type="occupation" class="key-info" tabindex="1" value="Occupation" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	<input type="email" class="key-info" tabindex="1" value="EMail Address" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	<input type="password" class="key-info" tabindex="2" placeholder="Password" required>

			<select class="selectmenu">
  				<option value="Date of Birth">Date of Birth</option>
  				<option value="Select date">Select date</option>
  				<option value="Select date">Select date</option>
  				<option value="Select date">Select date</option>
			</select>
			
			<span class="date">
			(Click in the box for date picker, or click again just to type it.)
			</span>
			
			<select class="selectmenu">
					<option value="Date of Birth">How did you hear about enclothed?</option>
					<option value="The Internet">The Internet</option>
					<option value="Word of Mouth">Word of Mouth</option>
					<option value="A Friend ">A Friend </option>
					<option value="Magazine Advert">Magazine Advert</option>
					<option value="Email Marketing">Email Marketing</option>
					<option value="Magazine Article">Magazine Article</option>
					<option value="Promotional Material">Promotional Material</option>
					<option value="Other">Other</option>
			</select>
			
			<select class="selectmenu">
					<option value="Date of Birth">Are you purchasing for another person?</option>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
			</select>
		 	  	
		 	  	</div><!--mini-wrapper-forms-->
		 	  	
		  <div class="mini-wrapper5">
		  	<a href="http:/#/" class="button4">Save and continue</a>
		 </div><!--mini-wrapper4-->
		 
 </div><!--styles-block-->
            </div>            
		</div>
	</div>
</div>








<h3><?php the_title(); ?></h3> 
<form action="" method="POST" name='section_1'>
	<?php $nonce = wp_create_nonce( get_uri() ); ?>
	<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

	<div style="float:left;">
		<input type="text" name="section_1[name]" placeholder='Full Name' value="<?php @echo_if_exists($section['name']); ?>"><br>
		<input type="text" name="section_1[address]" placeholder='Address' value="<?php @echo_if_exists($section['address']); ?>"><br>
		<input type="text" name="section_1[city]" placeholder='Town / City' value="<?php @echo_if_exists($section['city']); ?>"><br>
		<input type="text" name="section_1[email]" placeholder='Email' value="<?php @echo_if_exists($section['email']); ?>"><br>
	</div>
	
	<div style="float:left; padding-left:30px;">
		<input type="text" name="section_1[post_code]" placeholder='Post Code' value="<?php @echo_if_exists($section['post_code']); ?>"><br>
		<input type="text" name="section_1[phone]" placeholder='Phone Number' value="<?php @echo_if_exists($section['phone']); ?>"><br>
		<input type="text" name="section_1[occupation]" placeholder='Occupation' value="<?php @echo_if_exists($section['occupation']); ?>"><br>
		<input type="password" name="section_1[password]" placeholder='Password' value="<?php @echo_if_exists($section['password']); ?>"><br>
	</div>

	<br><br><br><br><br><br>

	<div>
		<input type="text" name='section_1[dob]' placeholder='Date of Birth' value="<?php @echo_if_exists($section['dob']); ?>">

		<h5>How did you hear about Enclothed</h5>
		<select name="section_1[feedback_1]">
			<option value="0">Select One</option>
			<option value="word">Word of Mouth</option>
			<option value="Magazine">Magazine</option>
			<option value="other">Other</option>
		</select>
		<input type="text" name="section_1[feedback_2]" placeholder='What other...'>
	</div>
	

	<br><br><br><br><br><br>


	<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
	<button onclick="submit()">Save and Continue</button>
</form>


<?php get_footer(); ?>