<?php 
	if (!function_exists('sf_wp_path')) {
		function sf_wp_path() {
			if (strstr($_SERVER["SCRIPT_FILENAME"], "/wp-content/")) {
				return preg_replace("/\/wp-content\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
			} else {
			return preg_replace("/\/[^\/]+?\/themes\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
			}
		}
	}
	
	require_once( sf_wp_path() . '/wp-load.php' );
?>