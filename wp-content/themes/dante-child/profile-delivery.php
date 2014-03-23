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
 <div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div>
 </div><!--details-menu-->
  
 	<div class="styles-block">
 	<div class="fade-border-left"></div>
 	<div class="fade-border-right"></div>
    <form action="" method="POST" name='section_2'>
        <?php $nonce = wp_create_nonce( get_uri() ); ?>
            <div class="flashmessages"><?php flashMessagesDisplay(); ?></div>
 	<div class="title-header">
 	<div class="numbering2">01</div>
 	<div class="accordian-title">Customer information</div>
 	<div class="arrow-click"></div>
 	</div>
 	
				<div class="mini-wrapper-forms">
		 	  	<input type="text" class="customer-info" tabindex="1" value="Customer Address Line 1" required onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	<input type="text" class="customer-info" tabindex="1" value="Customer Address Line 2" required onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	<input type="town" class="key-info" tabindex="1" value="Town/City" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	<input type="text" class="key-info" tabindex="1" value="Post Code" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	<input type="text" class="customer-info2" tabindex="1" value="Name this Address"
		 	  	required onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	</div><!--mini-wrapper-forms-->
	
	<div class="title-header">
	<div class="numbering2">02</div>
	<div class="accordian-title">Alternative Address</div>
	<div class="arrow-click"></div>
	</div>
	
				<div class="mini-wrapper-forms">
		 	  	<input type="text" class="customer-info" tabindex="1" value="Customer Address Line 1" required onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	<input type="text" class="customer-info" tabindex="1" value="Customer Address Line 2" required onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	<input type="town" class="key-info" tabindex="1" value="Town/City" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	<input type="text" class="key-info" tabindex="1" value="Post Code" required
		 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	<input type="text" class="customer-info2" tabindex="2" value="Name this Address"
		 	  	required onfocus="if(this.value==this.defaultValue)this.value=''"    
		 	  	onblur="if(this.value=='')this.value=this.defaultValue">
		 	  	
		 	  	</div><!--mini-wrapper-forms-->

	<div class="title-header">
	<div class="numbering2">03</div>
	<div class="accordian-title">Billing Address</div>
	<div class="arrow-click"></div>
	</div>

			<div class="mini-wrapper-forms">
	 	  	<input type="text" class="customer-info" tabindex="1" value="Customer Address Line 1" required onfocus="if(this.value==this.defaultValue)this.value=''"    
	 	  	onblur="if(this.value=='')this.value=this.defaultValue">
	 	  	
	 	  	<input type="text" class="customer-info" tabindex="1" value="Customer Address Line 2" required onfocus="if(this.value==this.defaultValue)this.value=''"    
	 	  	onblur="if(this.value=='')this.value=this.defaultValue">
	 	  	
	 	  	<input type="town" class="key-info" tabindex="1" value="Town/City" required
	 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
	 	  	onblur="if(this.value=='')this.value=this.defaultValue">
	 	  	
	 	  	<input type="text" class="key-info" tabindex="1" value="Post Code" required
	 	  	onfocus="if(this.value==this.defaultValue)this.value=''"    
	 	  	onblur="if(this.value=='')this.value=this.defaultValue">
	 	  	
	 	  	<input type="text" class="customer-info2" tabindex="2" value="Name this Address"
	 	  	required onfocus="if(this.value==this.defaultValue)this.value=''"    
	 	  	onblur="if(this.value=='')this.value=this.defaultValue">
	 	  	
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