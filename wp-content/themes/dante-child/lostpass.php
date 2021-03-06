<?php
/**
*
* template name: Lost Password 
*
**/
get_header();

global $wpdb;

$error = '';
$success = '';

// check if we're in reset form
if( isset( $_POST['action'] ) && 'pass_reset' == $_POST['action'] ) 
{
	// $nonce = $_POST['tg_pwd_nonce'];
	// wp_verify_nonce($_POST['tg_pwd_nonce'], 'lost_pass_nonce'); 

	$email = trim($_POST['user_login']);

	if( empty( $email ) ) {
		$error = 'Enter a username or e-mail address..';
	} else if( ! is_email( $email )) {
		$error = 'Invalid username or e-mail address.';
	} else if( ! email_exists($email) ) {
		$error = 'There is no user registered with that email address.';
	} else {
		
			// lets generate our new password
		$random_password = wp_generate_password( 12, false );
		
			// Get user data by field and data, other field are ID, slug, slug and login
		$user = get_user_by( 'email', $email );
		
		$update_user = wp_update_user( array (
			'ID' => $user->ID, 
			'user_pass' => $random_password
			)
		);
		
			// if  update user return true then lets send user an email containing the new password
		if( $update_user ) {
			$profileDetails = new EnclothedProfile();
			$profile = $profileDetails->main->profiles_model->getFullProfile($email);
			//$message = 'Your new password is: '.$random_password;

			//$headers[] = 'MIME-Version: 1.0' . "\r\n";
			//$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers[] = "X-Mailer: PHP \r\n";
			//$headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";

			//$mail = wp_mail( $to, $subject, $message, $headers );
			$data = array();
			$data['email'] = $email;
			$data['name'] = strtoupper($profile->first_name.' '.$profile->last_name);
			$data['password'] = $random_password;
			$profileDetails->main->sendmail($data['email'], 'Your new password!', Emails_model::TEMPLATE_NEW_PASS, $data);
			
			$success = 'Check your email address for you new password.';
				
		} else {
			$error = 'Oops something went wrong updaing your account.';
		}

	}

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

<script type="text/javascript">
	jQuery("#wp_pass_reset").submit(function($) {
		$("#result").html("<span class='loading'>Validating...</span>").fadeIn();
		var input_data = $("#wp_pass_reset").serialize();
		$.ajax({
			type: "POST",
			url:  "'. get_permalink( $post->ID ).'",
			data: input_data,
			success: function(msg){
				$(".loading").remove();
				$("<div>").html(msg).appendTo("div#result").hide().fadeIn("slow");
			}
		});
		return false;
	});
</script>

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
								<h2 style="text-align: center;"><span style="color: #ffffff;">LOST PASSWORD</span></h2>
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
				
				<div class="col-sm-12 lost_password_wrapper" >
		
							<?php 
								if( ! empty( $error ) ):
									echo '<div class="georgia_text"><strong>ERROR:</strong> '. $error .'</div>';
								elseif( ! empty( $success ) ):
									echo '<div class="georgia_text"> '. $success .'</div>';
								else:
									echo '<div class="georgia_text">Reset your password</div>';
								endif;
							?>

					<div id="result"></div> <!-- To hold validation results -->
					<form id="wp_pass_reset" action="" method="post">
						<input type="text" class="key-info" name="user_login" value="" placeholder="USERNAME OR E-MAIL">
						<input type="hidden" name="action" value="pass_reset" />
						<input type="hidden" name="tg_pwd_nonce" value="<?php echo wp_create_nonce("lost_pass_nonce"); ?>" />
						<button type="submit" class="button4" id="submitbtn" name="submit" onclick="submit();">Reset</button>
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





