<?php
/**
*
* Plugin Name: LDM WP Streams Plugin
* Description: Like Digital Media all streams plugin 
* Author: Rodrigo Dias
* Author URI: http://likedigitalmedia.com
* Version: 0.1
* Provides: ldm-streams
*
**/

require_once('instagram.class.php');

class ldmStreams {

	public $config_filename = 'ldm-streams.ini';
	public $facebook; 
	public static $config; 
	public static $instagram; 

	public function __construct(){
		self::$config = parse_ini_file(dirname(__FILE__)."/".$this->config_filename, true); 
	}	


	public static function getInstagram(){
		if (!isset(self::$instagram)){
			$config = array(
				'apiKey' => self::$config['instagram']['client_id'],
				'apiSecret' => self::$config['instagram']['client_secret'],
				'apiCallback' => self::$config['instagram']['redirect_uri'],
			);
			self::$instagram = new Instagram($config);
		}	
		return self::$instagram; 
	}

	public function getInstagramPosts(){
		$id = self::$config['instagram']['enclothed_id'];
		$instagram = ldmStreams::getInstagram();
		$posts = $instagram->getUserMedia($id);
		return $posts; 
	}

	public function getInstagramLastPostCaption($num = 0){
		$posts = $this->getInstagramPosts();
		$postText = $posts->data[$num]->caption->text;
		$postText = (strlen($postText) > 185)?substr($postText, 0, 185)."...":$postText;
		return $postText;
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

	




