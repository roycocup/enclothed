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

require_once('instagram.class.php');

class ldmStreams {

	public $config_filename = 'ldm-streams.ini';
	public $config; 
	public $facebook; 
	public $instagram; 

	public function __construct(){
		$this->config = parse_ini_file(dirname(__FILE__)."/".$this->config_filename, true); 
	}	


	public function getInstagram(){
		$config = array(
			'apiKey' => $this->config['instagram']['client_id'],
			'apiSecret' => $this->config['instagram']['client_secret'],
			'apiCallback' => $this->config['instagram']['redirect_uri'],
		);
		return new Instagram($config);
	}

	public function getInstagramPosts(){
		$id = $this->config['instagram']['enclothed_id'];
		$instagram = $this->getInstagram();
		$posts = $instagram->getUserMedia($id);
		return $posts; 
	}

	public function getInstagramLastPostCaption($num = 0){
		$posts = $this->getInstagramPosts();
		return $posts->data[$num]->caption->text;
	}

	public function getInstagramLastPostTime($num = 0){
		$posts = $this->getInstagramPosts();
		return time_elapsed_52($posts->data[$num]->caption->created_time);
	}

	public function getInstagramLastPostImage($num = 0, $resolution = 'standard_resolution'){
		$posts = $this->getInstagramPosts();
		return $posts->data[$num]->images->$resolution->url;
	}


}

// Facebook posts already styled from functions.php
// $posts = get_fb_posts();

	




