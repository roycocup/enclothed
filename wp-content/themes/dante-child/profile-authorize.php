<?php
/**
*
* template name: Profile Authorize
*
**/
// if this page is accesses directly just http_redirect
if (empty($_SESSION['section_1']) || empty($_SESSION['section_6'])){
	echo 'This page cannot be accessed directly';
	return false;
}
get_header();
?>

<?php 


$ldm_sagepay = new ldm_sagepay();
$config = $ldm_sagepay->getConfig();

$config['vendor_name'] 		= 'EnclothedLtd';
$config['currency'] 		= 'GBP';
$config['total'] 			= '500.00';
$config['description'] 		= 'Enclothed concierge service.';
$config['customer_name']	= $_SESSION['section_1']['name'];

$names = explode(' ', $_SESSION['section_1']['name']); 		
$last_names = '';
foreach ($names as $k => $value) {
	if ($k == 0) continue; //bypass the first name
	$last_names .= $value.' '; 
}

$config['billing_first_names'] = $names[0];
$config['billing_surname'] 	= $last_names;
$config['billing_address1']	= $_SESSION['section_6']['bill_add_1'];
$config['billing_address2']	= $_SESSION['section_6']['bill_add_2'];
$config['billing_city']		= $_SESSION['section_6']['bill_town'];
$config['billing_postcode']	= $_SESSION['section_6']['bill_post_code'];
$config['billing_country']	= 'GB';
$config['billing_phone']	= '';

$sagepay = $ldm_sagepay->getInstance($config);
$form = $sagepay->renderForm();
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
								<h2 style="text-align: center;"><span style="color: #ffffff;">BUILD YOUR<br>ENCLOTHED PROFILE</span></h2>
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
							<?php echo $form; ?>
							<?php $nonce = wp_create_nonce( get_uri() ); ?>
							<div class="col-sm-12 payment_info_wrapper relative">								
								<div class="col-sm-4 payment_info">
									<img src="<?php bloginfo('template_url') ?>-child/images/icon_wallet.png" alt="" class="image-responsive" />
									<h3>We aren’t taking any money now.</h3>
								</div>
								<div class="col-sm-4 payment_info">
									<img src="<?php bloginfo('template_url') ?>-child/images/icon_creditcard.png" alt="" class="image-responsive" />
									<h3>We pre-authorise your card like a hotel. This verifies who you are, where you live and that you are a fine, upstanding citizen.</h3>
								</div>
								<div class="col-sm-4 payment_info" style="background:none !important; padding-bottom:0 !important;">
									<img style="background:none !important;" src="<?php bloginfo('template_url') ?>-child/images/icon_clothes.png" alt="" class="image-responsive" />
									<h3>We only charge you for what you keep when you return the box. We never charge your card without your say-so.</h3>
								</div>
							</div>

							<!-- <div class="col-xs-6">
								<label class="css-label" style="">Gift Card Code</label>
								<input type='text' class="promo_code" id='' tabindex="9" placeholder='Do you have a Gift Card Code?' name='giftcode'  value="">
							</div>

							<div class="col-xs-6">
								<label class="css-label" style="">Promotion Code</label>
								<input type='text' class="promo_code" id='' tabindex="9" placeholder='Do you have a Promotional Code?' name='promocode'  value="">
							</div> -->
							
							<!-- <div class="shadow"><img src="<?php bloginfo('template_url') ?>-child/images/shadow.png" alt="" /></div> -->

							
							<div class="mini-wrapper5">
								<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
					            <a href="/profile/delivery/" class="button4">Go Back</a>
    				            <div class="button_spacer col-sm-1 hidden-xs"></div>
                   				<button class="button4" onclick="submit()">Proceed to Payment</button>
							</div><!--mini-wrapper4-->
						</form>

						<!--styles-block-->
					</div>            
				</div>
			</div>
			<!-- CLOSE page -->
		</div>
	<?php endif; ?>
</div>
</div>

<?php get_footer(); ?>
