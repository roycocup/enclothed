<?php
/**
*
* template name: Profile Delivery
*
**/
?>
<?php get_header(); ?>


<script>
	jQuery(document).ready(function($){

		// start with the alternate address hidden
		$('.billing-address-wrapper').hide();

		$('#checkbox1').click(function(){
			if (this.checked){
				// if the box is checked we dont need another address because its the same one as main
				$('.billing-address-wrapper').slideUp('slow');
			}else{
				$('.billing-address-wrapper').slideDown('slow');
			}
		});
	});	
</script>

<?php 
if (isset($_SESSION['section_5'])){
	$section = $_SESSION['section_5'];	
}else if(isset($_POST['section_5'])){
	$section = $_POST['section_5'];
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
								<h2 style="text-align: center;"><span style="color: #ffffff;">BUILD YOUR<br>
									ENCLOTHED PROFILE</span></h2>
									<p style="margin-bottom: 0;"><img class="size-full aligncenter" alt="line" src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/line.png"></p>
								</div> 
							</div>
								<div class="flashmessages col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
				            		<?php flashMessagesDisplay(); ?>
				           		</div>	
				 		</div>
						<div class="row">
							<!-- Main Menu -->
							<div class="styles-block">
								<div class="fade-border-left"></div>
								<div class="fade-border-right"></div>
								<form action="" method="POST" name='section_2'>
									<?php $nonce = wp_create_nonce( get_uri() ); ?>


									<!-- Main Address  -->
									<div class="title-header no-border-top">
										<div class="numbering2">01</div>
										<div class="accordian-title">Delivery Address</div>
										<!-- <div class="arrow-click" id='arrow1'></div> -->
									</div>

									<div class="mini-wrapper-forms">
										<input type="text" class="customer-info" tabindex="1" placeholder="Customer Address Line 1" name="" value="">		 	  	
										<input type="text" class="customer-info" tabindex="1" placeholder="Customer Address Line 2" name="" value="">
										<input type="text" class="key-info" tabindex="1" placeholder="Town/City" name="" value="">
										<input type="text" class="key-info" tabindex="1" placeholder="Post Code" name="" value="">
										<input type="text" class="customer-info" tabindex="2" placeholder="Name this Address" name="" value="">		 	  
										<div class="checkbox_wrap" >
											<input type="checkbox" class="css-checkbox" id="checkbox1" checked>
											<label for="checkbox1" name="checkbox1_lbl" class="css-label tickbox">- MY BILLING ADDRESS IS THE SAME AS THIS ADDRESS</label>
										</div>	
									</div>
									

									<!-- Billing Address -->
									<div class="billing-address-wrapper">
										<div class="title-header">
											<div class="shadow_inverse"><img src="<?php bloginfo('template_url') ?>-child/images/shadow_inverse.png" alt="" /></div>
											<div class="numbering2">02</div>
											<div class="accordian-title">Billing Address</div>
											<!-- <div class="arrow-click" id='arrow2'></div> -->
										</div>

										<div class="mini-wrapper-forms ">
											<input type="text" class="customer-info" tabindex="1" placeholder="Alternative Address Line 1" name="" value="">		 	  	
											<input type="text" class="customer-info" tabindex="1" placeholder="Alternative Address Line 2" name="" value="">	  	
											<input type="text" class="key-info" tabindex="1" placeholder="Alternative Town/City" name="" value="">
											<input type="text" class="key-info" tabindex="1" placeholder="Alternative Post Code" name="" value="">
											<input type="text" class="customer-info" tabindex="2" placeholder="Name this Address" name="" value="">
										</div>
									</div>	






									<!-- <div class="title-header">
										<div class="shadow_inverse"><img src="<?php bloginfo('template_url') ?>-child/images/shadow_inverse.png" alt="" /></div>
										<div class="numbering2">03</div>
										<div class="accordian-title">Billing Address</div>
										<div class="arrow-click"></div>
									</div>

									<div class="mini-wrapper-forms">
										<input type="text" class="customer-info" tabindex="1" placeholder="Billing Address Line 1" name="" value="">
										<input type="text" class="customer-info" tabindex="1" placeholder="Billing Address Line 2" name="" value="">
										<input type="text" class="key-info" tabindex="1" placeholder="Billing Town/City" name="" value="">
										<input type="text" class="key-info" tabindex="1" placeholder="Billing Post Code" name="" value="">
										<input type="text" class="customer-info2" tabindex="2" placeholder="Name this Address" name="" value="">

									</div> --> 

									<div class="line_separator">
										<div class="shadow_inverse"><img src="http://enclothed.dev/wp-content/themes/dante-child/images/shadow_inverse.png" alt=""></div>
									</div>

									<label for="checkbox1"class="css-label">Is there anything extra you'd like to add about delivery?</label>
									<textarea type="text" class="customer-info3" tabindex="2" placeholder="" name="" value=""></textarea>
									<label for="checkbox1"class="css-label">Is there anything extra you'd like to add about collection?</label>
									<textarea type="text" class="customer-info3" tabindex="2" placeholder="" name="" value=""></textarea>

									<div class="mini-wrapper5">
										<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
						                <a href="/profile/pricing/" class="button4">Go Back</a>
 						                <div class="button_spacer col-sm-1 hidden-xs"></div>
 						                <button class="button4" onclick="submit()">Save and Continue</button>
									</div><!--mini-wrapper4-->
								</form>
								<!--styles-block-->
							</div>            
						</div>
					</div>

				</div>
				<!-- CLOSE page -->

			<?php endif; ?>


		</div>
		<?php if ($sidebar_config != "no-sidebars" || $pb_active != "true") { ?>
	</div>
	<?php } ?>

	<!--// WordPress Hook //-->
	<?php get_footer(); ?>


