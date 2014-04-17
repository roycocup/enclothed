<?php

// error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('Europe/London');


$path = dirname(dirname( __FILE__ ));

require_once $path . '/wp-config.php';
//require_once $path . '/wp-load.php';
//require_once $path . '/wp-includes/wp-db.php';
//require_once $path . '/wp-includes/pluggable.php';


//global $table_prefix, $wp_embed, $wp_locale, $_wp_deprecated_widgets_callbacks, $wp_widget_factory;
global $wpdb, $current_site, $current_blog, $wp_rewrite, $shortcode_tags, $wp;
