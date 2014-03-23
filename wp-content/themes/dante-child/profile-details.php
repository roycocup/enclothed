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
		<div class="page-content clearfix">
			<div class="row">
                <div class="full-width-text spb_content_element col-sm-12 spb_text_column no-padding-top">
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
 			<li><span class="active">Your Details</span></li>
 			<li class="hidden-sm hidden-xs"><span>Pick your Style</span></li>
 			<li class="hidden-sm hidden-xs"><span>Size and Color</span></li>
 			<li class="hidden-sm hidden-xs"><span>Price and Summary</span></li>
 			<li class="hidden-sm hidden-xs"><span style="border-right:none;">Delivery</span></li>
 		</ul>
 <div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
 </div><!--details-menu-->
  
 	<div class="styles-block">
 	<div class="fade-border-left"></div>
 	<div class="fade-border-right"></div>
    <form action="" method="POST" name='section_1'>
        <?php $nonce = wp_create_nonce( get_uri() ); ?>
            <div class="flashmessages"><?php flashMessagesDisplay(); ?></div>
			<div class="title-forms">
				<div class="mini-wrapper-forms">
		 	  	<div class="numbering">01</div>
		 	  	<p>Some Key Pieces of information we need about you.</p>
		 	  	<input type="text" class="key-info" tabindex="1" name="section_1[name]" placeholder='Full Name' value="<?php @echo_if_exists($section['name']); ?>" >
		 	  	<input type="text" class="key-info" tabindex="2" name="section_1[address]" placeholder='Address' value="<?php @echo_if_exists($section['address']); ?>">
		 	  	<input type="text" class="key-info" tabindex="3" name="section_1[city]" placeholder='Town / City' value="<?php @echo_if_exists($section['city']); ?>">
		 	  	<input type="text" class="key-info" tabindex="4" name="section_1[email]" placeholder='Email' value="<?php @echo_if_exists($section['email']); ?>">
		 	  	<input type="text" class="key-info" tabindex="5" name="section_1[post_code]" placeholder='Post Code' value="<?php @echo_if_exists($section['post_code']); ?>">
		 	  	<input type="text" class="key-info" tabindex="6" name="section_1[phone]" placeholder='Phone Number' value="<?php @echo_if_exists($section['phone']); ?>">
		 	  	<input type="text" class="key-info" tabindex="7" name="section_1[occupation]" placeholder='Occupation' value="<?php @echo_if_exists($section['occupation']); ?>">
		 	  	<input type="password" class="key-info"  name="section_1[password]" placeholder='Password' value="<?php @echo_if_exists($section['password']); ?>">

			<select class="selectmenu" tabindex="9" name='section_1[dob]' placeholder='Date of Birth' value="<?php @echo_if_exists($section['dob']); ?>">
				<option value="0">Date of Birth</option>
  				<option value="Select date">Select date</option>
  				<option value="Select date">Select date</option>
  				<option value="Select date">Select date</option>
			</select>
			
			<span class="date">
			(Click in the box for date picker, or click again just to type it.)
			</span>
			
			<select class="selectmenu" tabindex="10" name="section_1[feedback_1]">
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
			
			<select class="selectmenu" tabindex="11" name="section_1[another_person]">
					<option value="Date of Birth">Are you purchasing for another person?</option>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
			</select>
		 	  	
		 	  	</div><!--mini-wrapper-forms-->
		 	  	
		  <div class="mini-wrapper5">
            		<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
                <button class="button4" onclick="submit()">Save and Continue</button>
		 </div><!--mini-wrapper4-->
		 
                 </div>
                </form>
                 <!--styles-block-->
            </div>            
		</div>
</div>

</div>
<?php get_footer(); ?>