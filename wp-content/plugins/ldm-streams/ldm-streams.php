<?php
/**
*
* Plugin Name: LDM WP Streams Plugin
* Description: Like Digital Media all streams plugin 
* Author: Like Digital Media
* Author URI: http://likedigitalmedia.com
* Version: 0.1
* Provides: ldm-streams
*
**/

// include_once 'facebook3.php';
//include_once 'twitter.php';


class ldmStreams {

	public $config_filename = 'ldm-streams.ini';
	public $config; 
	public $facebook; 

	public function __construct(){
		$this->config = parse_ini_file(dirname(__FILE__)."/".$this->config_filename, true); 
	}	

	public function getFacebookPosts(){
		return recent_facebook_posts();
	}

}


$streams = new ldmStreams();
// $posts = $streams->getFacebookPosts();
// var_dump($posts); 


