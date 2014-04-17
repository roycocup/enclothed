<?php
/**
*
* Template name: Dashboard 
*
**/

if (!is_user_logged_in()){
	return false;
}


get_header(); ?>


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
								<h2 style="text-align: center;"><span style="color: #ffffff;">DASHBOARD</span></h2>
								<p style="margin-bottom: 0;"><img class="size-full aligncenter" alt="line" src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/line.png"></p>
							</div> 
						</div>
					</div>
					<div class="row">
						<!-- Main Menu -->

						<div class="styles-block">
							<div class="fade-border-left"></div>
							<div class="fade-border-right"></div>
							<?php $nonce = wp_create_nonce( get_uri() ); ?>
							<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>

							<div class="flashmessages col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
									<?php flashMessagesDisplay(); ?>  
							</div>

							<div class="col-sm-10 dashboard_wrapper no-borders">
								<h1><small>We are building you a box. <br>Please contact us at <a href="mailto:hello@enclothed.co.uk">hello@enclothed.co.uk</a></small></h1>
							</div>

							<?php 
								//get all profile for this user
								global $current_user; 
								$main = new EnclothedMain();
								$profile = $main->profiles_model->getFullProfile($current_user->user_email);
								//get the addresses
								$delivery = $profile->delivery_add_1." ".$profile->delivery_add_2.", ".$profile->delivery_town." ".$profile->delivery_post_code;
								$billing = $profile->bill_add_1." ".$profile->bill_add_2.", ".$profile->bill_town." ".$profile->bill_post_code;

								$same_address = false;
								if ($profile->delivery_add_1 == $profile->bill_add_1){
									$same_address = true;
								}
							?>
							<h2>Request a box</h2>
							<form action="" method="POST" name='more_box'>
								<?php $nonce = wp_create_nonce( get_uri() ); ?>

								<div class="row">
									<div class="col-xs-6 col-xs-offset-3">
										<?php if (!$same_address): ?>
											<select class="selectmenu" name="more_box[address]" id="more_box[addresses]">
												<option value="delivery"><?php echo $delivery; ?></option>
												<option value="billing"><?php echo $billing; ?></option>
											</select>
										<?php else: ?>
											<input type='text' name="more_box[address]" value='<?php echo $delivery; ?>'>
										<?php endif; ?>
									</div>
								</div>
								<br><br>

								<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
								<div class="mini-wrapper5">
									<button class="button4" onclick="submit()">Send Request</button>
								</div>
							</form>

						</div>


						<!-- <div class="styles-block">
							<div class="fade-border-left"></div>
							<div class="fade-border-right"></div>
							<?php $nonce = wp_create_nonce( get_uri() ); ?>
							<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
							<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

							 <div class="col-sm-10 dashboard_wrapper no-borders">
								<h2>Dashboard</h2>								
								<div class="col-sm-4 dashboard_info edit_profile click" >
									<div class="dashboard_icon"></div>
									<h3>Edit your profile</h3>
								</div>
								<div class="col-sm-4 dashboard_info edit_style click">
									<div class="dashboard_icon"></div>
									<h3>Edit your style</h3>
								</div>
								<div class="col-sm-4 dashboard_info edit_sizes click" >
									<div class="dashboard_icon"></div>
									<h3>Edit your sizes and colours</h3>
								</div>
								<div class="col-sm-4 dashboard_info edit_prices click" >
									<div class="dashboard_icon"></div>
									<h3>Edit your prices</h3>
								</div>
								<div class="col-sm-4 dashboard_info edit_delivery click" >
									<div class="dashboard_icon"></div>
									<h3>Edit your delivery</h3>
								</div>	
								<div class="col-sm-4 dashboard_info edit_collection click" >
									<div class="dashboard_icon"></div>
									<h3>Arrange collection</h3>
								</div>		
								<div style="clear:both;"></div>
								<div class="shadow"><img src="http://enclothed.dev/wp-content/themes/dante-child/images/shadow.png" alt=""></div>
							</div> -->

							<!-- <div class="col-sm-12 dashboard_wrapper no-margin-bottom">
								<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
								<h2>E-card</h2>								
								<p class="georgia_text">Please enter your details in the form below</p>
								<div class="mini-wrapper-forms">
									<input type="text" class="key-info" tabindex="1" placeholder="Your Name" name="" value="">
									<input type="text" class="key-info" tabindex="2" placeholder="Your Email" name="" value="">
									<input type="text" class="key-info" tabindex="3" placeholder="Recipients Name" name="" value="">
									<input type="text" class="key-info" tabindex="4" placeholder="Recipients Email" name="" value="">
									<input type="text" class="customer-info" tabindex="5" placeholder="Billing Address Line 1" name="" value="">		 	  	
									<input type="text" class="customer-info" tabindex="6" placeholder="Billing Address Line 2" name="" value="">	  	
									<input type="text" class="customer-info" tabindex="7" placeholder="Billing Address Line 3" name="" value="">
									<input type="text" class="key-info" tabindex="8" placeholder="Post Code" name="" value="">
									<input type="text" class="key-info" tabindex="9" placeholder="Phone Number" name="" value="">
									<input type="text" class="key-info" tabindex="10" placeholder="Gift Card Amount" name="" value="">
									<input type="text" class="key-info invisible-field" >
									<textarea type="text" class="customer-info3" tabindex="11"  placeholder="Personal Message" name="" value=""></textarea>
								</div>
							</div>

							<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
							<div class="mini-wrapper5">
								<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
								<button class="button4" onclick="submit()">Proceed to Payment</button>
							</div>
						</form>
					</div>-->








				</div>
			</div>
			<!-- CLOSE page -->
		</div>
	<?php endif; ?>
</div>
</div>

<?php get_footer(); ?>












<div class="container" style="display:none;">
	<h2>Dashboard</h2>


	<h2>Request a box</h2>
	<form action="" method="POST" name='more_box'>
		<?php $nonce = wp_create_nonce( get_uri() ); ?>
		<div class="flashmessages"><?php flashMessagesDisplay(); ?></div>

		<div class="row">
			<div class="col-xs-12">
				<select name="more_box[address]" id="more_box[addresses]">
					<option value="1">19, Ebeneezer Street, London N1 4LS</option>
					<option value="2">40, Gowan Stree, London EC1 5HJ</option>
				</select>
			</div>
			<br><br>

			<div class="col-xs-6">
				<label for="promocode">You have a promotional code? Great!</label>
				<input type="text" placeholder='Promotional Code' name='promocode'>	
			</div>

			<div class="col-xs-6">
				<label for="promocode">Did you receive a Gift Card? Insert its code here!</label>
				<input type="text" placeholder='Gift Card Code' name='giftcode'>
			</div>
		</div>
		<br><br>

		<input type="hidden" value="<?php echo $nonce; ?>" name='nonce'>
		<div class="mini-wrapper5">
			<button class="button4" onclick="submit()">Save & Send</button>
		</div>
	</form>
</div>
<?php get_footer(); ?>