<?php
/**
*
* template name: Login 
*
**/

//wp_enqueue_script( 'jquery' );
get_header();
?>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script>

	$(document).ready(function($){

		// $('.flashmessages').hide();

		//Old ajax login
		// $('#login-bnt').click(function(){
		// 	var user = $('#user').val(); 
		// 	var pass = $('#password').val();
		// 	console.log('user:' + user, 'pass:' + pass);
		// 	ajax_login(user, pass);
		// });

		// function ajax_login(user, pass){
		// 	var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		// 	$.ajax({
		// 		type:'POST',
		// 		url:ajaxurl,
		// 		data: { 
		// 			action: 'enc_ajax_getvars',
		// 			function_name: '_ajax_login',
		// 			parameters: [user, pass],
		// 		},
		// 		error:function(e){
		// 			console.log(e);
		// 		},
		// 		success: function(data) {
		// 			if(data == "true"){
		// 				$('.flashmessages').html("Welcome!").fadeIn('slow');
		// 				setTimeout(function(){window.location.replace("<?php echo home_url();?>");}, 1000);
		// 			}else {
		// 				$('.flashmessages').html("Wrong credentials. Please try again.").fadeIn('slow');
		// 				setTimeout(function(){}, 3000);
		// 			}
		// 		}
		// 	});
		// }

	});
		
	
</script>

<?php 
$ldm_sagepay = new ldm_sagepay();
$config = $ldm_sagepay->getConfig();
$config['total'] = '500';
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
								<h2 style="text-align: center;"><span style="color: #ffffff;">LOG IN</span></h2>
								<p style="margin-bottom: 0;"><img class="size-full aligncenter" alt="line" src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/line.png"></p>
							</div> 
						</div>
					</div>
					<div class="row">
						<!-- Main Menu -->

						<div class="styles-block">
							<div class="line_separator_thick"><img src="<?php bloginfo('template_url') ?>-child/images/line_thick.png" alt=""/></div>
							<div class="fade-border-left"></div>
							<div class="fade-border-right"></div>
			<?php $user = wp_get_current_user(); ?>
			<?php if(empty($user->data)): ?>
				
				<div class="col-sm-12 login_wrapper" >
					<?php 
						if (sessionHasMessages()): ?>
							<div class="georgia_text">Wrong credentials!</div>
							<?php unset($_SESSION['messages']); ?>
						<?php else :?>
							<div class="georgia_text">Please login</div>
						<?php endif; ?>
					
					<form action="" method="post">
						<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('home_login'); ?>" />
						<input type="text" class="key-info" name='user' id='user' tabindex="1" placeholder="Email">
						<input type="password" class="key-info" name='password' id='password' tabindex="1" placeholder="password">
						<a href="/home/lostpass" title="Lost Password" class="lost_password">Lost Password?</a>
						<button class="button4" id='login-bnt'>log in</button>
					</form>
				</div>
			<?php else: ?>
				<div>You are already logged in</div>
			<?php endif; ?>
							

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

