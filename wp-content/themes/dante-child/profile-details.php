<?php
/**
*
* template name: Profile Details
*
**/
?>

<?php get_header(); ?>

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css"> -->
<script>
// $(document).ready(function(){
// 	$( "#datepicker" ).datepicker( $.datepicker.regional[ "uk" ] );
// 	$( "#datepicker" ).datepicker( "option", "dateFormat", 'dd-mm-yy' );
// 	$( "#datepicker" ).datepicker();
// });

</script>

<?php 
if (isset($_SESSION['section_1'])){
	$section = $_SESSION['section_1'];	
}else if(isset($_POST['section_1'])){
	$section = $_POST['section_1'];
} else {
	$section = array();
}


?>
	
<?php
	$options = get_option('sf_dante_options');
	
	$default_show_page_heading = $options['default_show_page_heading'];
	$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
	$default_sidebar_config = $options['default_sidebar_config'];
	$default_left_sidebar = $options['default_left_sidebar'];
	$default_right_sidebar = $options['default_right_sidebar'];
	
	$pb_active = get_post_meta($post->ID, '_spb_js_status', true);
	$show_page_title = get_post_meta($post->ID, 'sf_page_title', true);
	$page_title_style = get_post_meta($post->ID, 'sf_page_title_style', true);
	$page_title = get_post_meta($post->ID, 'sf_page_title_one', true);
	$page_subtitle = get_post_meta($post->ID, 'sf_page_subtitle', true);
	$page_title_bg = get_post_meta($post->ID, 'sf_page_title_bg', true);
	$fancy_title_image = rwmb_meta('sf_page_title_image', 'type=image&size=full');
	$page_title_text_style = get_post_meta($post->ID, 'sf_page_title_text_style', true);
	$fancy_title_image_url = "";
	
	if ($show_page_title == "") {
		$show_page_title = $default_show_page_heading;
	}
	if ($page_title_bg == "") {
		$page_title_bg = $default_page_heading_bg_alt;
	}
	if ($page_title == "") {
		$page_title = get_the_title();
	}
	
	foreach ($fancy_title_image as $detail_image) {
		$fancy_title_image_url = $detail_image['url'];
		break;
	}
									
	if (!$fancy_title_image) {
		$fancy_title_image = get_post_thumbnail_id();
		$fancy_title_image_url = wp_get_attachment_url( $fancy_title_image, 'full' );
	}
	
	$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = get_post_meta($post->ID, 'sf_left_sidebar', true);
	$right_sidebar = get_post_meta($post->ID, 'sf_right_sidebar', true);
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
	
	sf_set_sidebar_global($sidebar_config);
	
	$page_wrap_class = $post_class_extra = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	$post_class_extra = 'col-sm-8';
	} else if ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	$post_class_extra = 'col-sm-8';
	} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars row';
	$post_class_extra = 'col-sm-9';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
	
	$remove_breadcrumbs = get_post_meta($post->ID, 'sf_no_breadcrumbs', true);
	$remove_bottom_spacing = get_post_meta($post->ID, 'sf_no_bottom_spacing', true);
	$remove_top_spacing = get_post_meta($post->ID, 'sf_no_top_spacing', true);
	
	if ($remove_bottom_spacing) {
	$page_wrap_class .= ' no-bottom-spacing';
	}
	if ($remove_top_spacing) {
	$page_wrap_class .= ' no-top-spacing';
	}
	
	$options = get_option('sf_dante_options');
	$disable_pagecomments = false;
	if (isset($options['disable_pagecomments']) && $options['disable_pagecomments'] == 1) {
	$disable_pagecomments = true;
	}
?>


<?php if ($sidebar_config != "no-sidebars" || $pb_active != "true") { ?>
<div class="container">
<?php } ?>

<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
		
	<?php if (have_posts()) : the_post(); ?>

	<!-- OPEN page -->
	<div <?php post_class('clearfix ' . $post_class_extra); ?> id="<?php the_ID(); ?>">
	
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

				<input type='text' class="selectmenu" id='datepicker' tabindex="9" name='section_1[dob]' placeholder='Date of Birth' value="<?php @echo_if_exists($section['dob']); ?>">
				
			
			
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


	
	<!-- CLOSE page -->
	</div>

	<?php endif; ?>
	

</div>

<?php if ($sidebar_config != "no-sidebars" || $pb_active != "true") { ?>
</div>
<?php } ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>


