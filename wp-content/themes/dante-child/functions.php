<?php
	
	/*
	*
	*	Dante Functions - Child Theme
	*	------------------------------------------------
	*	These functions will override the parent theme
	*	functions. We have provided some examples below.
	*
	*
	*/
	
	
	// OVERWRITE PAGE BUILDER ASSETS
//	function spb_regsiter_assets() {
//		require_once( get_stylesheet_directory_uri() . '/default.php' );
//	}
//	if (is_admin()) {
//	add_action('admin_init', 'spb_regsiter_assets', 2);
//	}
//	if (!is_admin()) {
//	add_action('wp', 'spb_regsiter_assets', 2);
//	}

if (!function_exists('get_fb_posts')){
	function get_fb_posts($num, $truncate_words = false){
		$posts = get_facebook_posts();
		$i = 1;
		foreach ($posts as $post) {
			if ($i > $num) break;
			$post_content = $post['content']; 
			if (!empty($truncate_words)){
				$post_content = wp_trim_words( $post_content, $truncate_words); 
			}
			$time = time_elapsed($post['timestamp']);

			echo "<div class='fb_post' style='padding-bottom:20px'>";
			echo "<div class='fb_post_content'>$post_content</div>";
			echo "<div class='fb_time'>$time</div>";	
			echo "</div>";
			$i++;
		}		
	}
}


if ( !function_exists( 'debug_log' ) ) {
	function debug_log( $msg, $status = 'DEBUG', $file = 'debug_log.txt' ) {
		$location = 
		$msg = gmdate( 'Y-m-d H:i:s' ) . ' - ' . $status . ' - ' .print_r( $msg, TRUE ) . "\n";
		file_put_contents( $file , $msg, FILE_APPEND);
	}
}

/**
*
* This will add all the custom JS files
*
**/
function my_add_frontend_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('jquery-ui-slider');
}
add_action('wp_enqueue_scripts', 'my_add_frontend_scripts');

/**
*
* This will add all the custom stylesheets for the JS above 
*
**/
function add_jquery_stylesheets(){
	wp_enqueue_style('jquery-css', '//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css');
}
add_action('wp_enqueue_scripts', 'add_jquery_stylesheets');


/**
*
* Changing logo on the admin page 
*
**/
function admin_logo() { ?>
    <style type="text/css">#login h1 a {background-image: url( '<?php echo bloginfo( "stylesheet_directory" )."/images/logo-black.png"; ?>' )!important;}</style>
<?php }
add_action( 'login_enqueue_scripts', 'admin_logo' );


/* CONTENT FUNCTIONS
================================================== */
if (!function_exists('sf_custom_content_extend')) {
	function sf_custom_content_extend() {
		include_once( bloginfo('stylesheet_directory') . 'includes/sf-header.php' );
	}
	add_action('init', 'sf_custom_content_extend', 0);
}
			

?>