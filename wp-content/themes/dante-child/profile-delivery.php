<?php
/**
*
* template name: Profile Delivery
*
**/

get_header();
if (isset($_SESSION['section_2'])){
	$section = $_SESSION['section_2'];	
}else if(isset($_POST['section_2'])){
	$section = $_POST['section_2'];
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
 			<li class="hidden-sm hidden-xs"><span>Your Details</span></li>
 			<li class="hidden-sm hidden-xs"><span>Pick your Style</span></li>
 			<li class="hidden-sm hidden-xs"><span>Size and Color</span></li>
 			<li class="hidden-sm hidden-xs"><span>Price and Summary</span></li>
 			<li><span  class="active" style="border-right:none;">Delivery</span></li>
 		</ul>
 </div><!--details-menu-->
  
 	<div class="styles-block">
 	<div class="fade-border-left"></div>
 	<div class="fade-border-right"></div>
    <form action="" method="POST" name='section_2'>
        <?php $nonce = wp_create_nonce( get_uri() ); ?>
            <div class="flashmessages"><?php flashMessagesDisplay(); ?></div>
 	<div class="title-header no-border-top">
 	<div class="numbering2">01</div>
 	<div class="accordian-title">Customer information</div>
 	<div class="arrow-click"></div>
 	</div>
 	
				<div class="mini-wrapper-forms">
		 	  	<input type="text" class="customer-info" tabindex="1" placeholder="Customer Address Line 1" name="" value="">		 	  	
		 	  	<input type="text" class="customer-info" tabindex="1" placeholder="Customer Address Line 2" name="" value="">
		 	  	<input type="town" class="key-info" tabindex="1" placeholder="Town/City" name="" value="">
		 	  	<input type="text" class="key-info" tabindex="1" placeholder="Post Code" name="" value="">		 	  	
		 	  	<input type="text" class="customer-info2" tabindex="1" placeholder="Name this Address" name="" value="">
		 	  	
		 	  	</div><!--mini-wrapper-forms-->
	
	<div class="title-header">
	<div class="numbering2">02</div>
	<div class="accordian-title">Alternative Address</div>
	<div class="arrow-click"></div>
    <div class="shadow_inverse"><img src="<?php bloginfo('template_url') ?>-child/images/shadow_inverse.png" alt="" /></div>
	</div>
	
				<div class="mini-wrapper-forms">
		 	  	<input type="text" class="customer-info" tabindex="1" placeholder="Alternative Address Line 1" name="" value="">		 	  	
		 	  	<input type="text" class="customer-info" tabindex="1" placeholder="Alternative Address Line 2" name="" value="">	  	
		 	  	<input type="town" class="key-info" tabindex="1" placeholder="Alternative Town/City" name="" value="">
		 	  	<input type="text" class="key-info" tabindex="1" placeholder="Alternative Post Code" name="" value="">
		 	  	<input type="text" class="customer-info2" tabindex="2" placeholder="Name this Address" name="" value="">
		 	  	
		 	  	</div><!--mini-wrapper-forms-->

	<div class="title-header">
	<div class="numbering2">03</div>
	<div class="accordian-title">Billing Address</div>
	<div class="arrow-click"></div>
    <div class="shadow_inverse"><img src="<?php bloginfo('template_url') ?>-child/images/shadow_inverse.png" alt="" /></div>
	</div>

			<div class="mini-wrapper-forms">
	 	  	<input type="text" class="customer-info" tabindex="1" placeholder="Billing Address Line 1" name="" value="">
	 	  	<input type="text" class="customer-info" tabindex="1" placeholder="Billing Address Line 2" name="" value="">
	 	  	<input type="town" class="key-info" tabindex="1" placeholder="Billing Town/City" name="" value="">
	 	  	<input type="text" class="key-info" tabindex="1" placeholder="Billing Post Code" name="" value="">
	 	  	<input type="text" class="customer-info2" tabindex="2" placeholder="Name this Address" name="" value="">
            
	 	  	</div><!--mini-wrapper-forms-->
		 	  	
		  <div class="mini-wrapper5">
            		<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
                <button class="button4" onclick="submit()">Save and Continue</button>
		 </div><!--mini-wrapper4-->
                </form>
                 <!--styles-block-->
            </div>            
		</div>
</div>

</div>
<?php get_footer(); ?>