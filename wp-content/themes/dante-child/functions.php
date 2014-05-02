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

add_image_size( 'home-featured', 400, 400, true);

if (!function_exists('pc_lookup')){
	function pc_lookup($postcode) {

		// Sanitize their postcode:
		$search_code = urlencode($postcode);
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . $search_code . '&sensor=false';
		$json = json_decode(file_get_contents($url));

		$lat = $json->results[0]->geometry->location->lat;
		$lng = $json->results[0]->geometry->location->lng;

		// Now build the lookup:
		$address_url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lng . '&sensor=false';
		$address_json = json_decode(file_get_contents($address_url));
		$address_data = $address_json->results[0]->address_components;

		return $address_data;

		$street = str_replace('Dr', 'Drive', $address_data[1]->long_name);
		$town = $address_data[2]->long_name;
		$county = $address_data[3]->long_name;

		$array = array('street' => $street, 'town' => $town, 'county' => $county);
		return json_encode($array);
	}
}


/**
*
* This function is highly coupled with a plugin that must not be updated
* or the function will be lost 
*
**/
if (!function_exists('get_fb_posts')){
	function get_fb_posts($num, $truncate_words = false, $divs = true){
		$posts = get_facebook_posts();
		$i = 1;
		foreach ($posts as $post) {
			if ($i > $num) break;
			if ($i < $num) {$i++; continue;}
			if (empty($post['content'])) {
				$post_content = $post['link_description']; 
			} elseif(!empty($post['content'])) {
				$post_content = $post['content']; 
			} else {
				$post_content = 'Enclothed - Men\'s bespoke outfitters';
			}

			$post_content = utf8_decode($post_content);

			$post_content = wp_trim_words($post_content, $truncate_words); 

			$post_content = make_clickable($post_content);

			if ($divs){
				echo "<div class='fb_post' style='padding-bottom:20px'>";
				echo "<div class='fb_post_content'>$post_content</div>";
				echo "</div>";
			} else {
				echo $post_content;
			}
			 
			$i++;
		}		
	}
}

/**
*
* This function is highly coupled with a plugin that must not be updated
* or the function will be lost 
*
**/
if (!function_exists('get_fb_posts_time')){
	function get_fb_posts_time($num, $truncate_words = false, $divs = true){
		$posts = get_facebook_posts();
		$i = 1;
		foreach ($posts as $post) {
			if ($i > $num) break;
			if ($i < $num) {$i++; continue;}
			if (empty($post['content'])) {
				$post_content = $post['link_description']; 
			} elseif(!empty($post['content'])) {
				$post_content = $post['content']; 
			} else {
				$post_content = 'Enclothed - Men\'s bespoke outfitters';
			}

			
			//$time = time_elapsed($post['timestamp']);
			$time = time_elapsed_52($post['timestamp']);

			if ($divs){
				echo "<div class='fb_post' style='padding-bottom:20px'>";
				echo "<div class='fb_post_content'>$post_content</div>";
				echo "<div class='fb_time'>$time</div>";	
				echo "</div>";
			} else {
				echo $time;
			}
			 
			$i++;
		}		
	}
}


if ( !function_exists( 'get_fb_post_image' ) ) {
	function get_fb_post_image($num){
		$posts = get_facebook_posts();
		$i = 1;
		foreach ($posts as $post) {
			if ($i > $num) break;
			//this makes the $num return the image number and not the number of images to return 
			if ($i < $num) {$i++; continue;}
			
			if (empty($post['image'])) {
				//default the image
				$post_image = 'default';
			} else {
				$post_image = $post['image'];
			}

			$str = '';
			if ($post_image == 'default'){
				// $default_image = get_stylesheet_directory_uri().'/images/logo_default_icon.png';
				// $str .= $default_image;
				$str = $post_image;
			} else {
				$str .= 'http://'.$post_image.'?type=normal';
			}
			$i++;
		}
		return $str;
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


/**
*
* This is an extension of the swift dante header functionality 
* this particular bit will enable us to work with the include on the child-theme
*
**/
if (!function_exists('sf_custom_content_extend')) {
	function sf_custom_content_extend() {
		include_once( 'includes/sf-header.php' );
	}
	add_action('init', 'sf_custom_content_extend', 0);
}
			
add_filter('show_admin_bar', '__return_false');

if (!function_exists('enc_make_clickable')) {
	function enc_make_clickable($text, $target)
	{
		$clickable_text = make_clickable($text);

		if(!empty($target)) {
			return str_replace('<a href="', '<a target="'.$target.'" href="', $clickable_text);
		}

		return $clickable_text;
	}
}

// Block all users except admins from the /wp-admin/ url
function block_wp_admin_init() {
	if (strpos(strtolower($_SERVER['REQUEST_URI']),'/wp-admin/') !== false) {
	
		if ( !is_super_admin() ) {
		
			wp_redirect( get_option('siteurl'), 302 );
		
		}
	
	}

}
add_action('init','block_wp_admin_init',0);




?>