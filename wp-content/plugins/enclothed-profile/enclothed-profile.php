<?php

/**
*
* Plugin Name: Enclothed Profile
* Provides: enc_profile
* Description: A custom built plugin to intake and process specific user profile forms
* Author: Like Digital Media
* Author URI: http://likedigitalmedia.com
* Version: 0.1
* Depends: enc_main
* Provides: enc_profile
*
**/


require_once(dirname(plugin_dir_path(__FILE__)) . "/enclothed-main/enclothed-main.php");


add_action('init', 'enc_profile_init');
function enc_profile_init(){
	$enclothed = new EnclothedProfile();
	$enclothed->process_my_forms();
}

// add_action( 'init', array('EnclothedProfile', 'process_my_form' ));

class EnclothedProfile {

	public $main; //main class

	public function __construct(){
		$this->main = new EnclothedMain(); 
	}


	//This will process every single form for the user extended profile.
	public function process_my_forms() {
		if (!empty($_POST['nonce'])){

			//we will call each method based on 
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/address/' ) ) {
				$this->process_address_form();
			}	
			if ( wp_verify_nonce( $_POST['nonce'], '/profile/sizing/' ) ) {
				$this->process_sizing_form();
			}
		}
	}


	public function process_address_form(){
		setFlashMessage('error', 'this is an error message');
		setFlashMessage('success', 'this is a success message');
		wp_redirect( home_url().'/profile/sizing' ); 
		exit;
	}


	public function process_sizing_form(){
		$data = 'this is the data';
		global $current_user;
		$this->main->sendmail($current_user->data->user_email, 'Thank you!', Emails_model::TEMPLATE_THANK_YOU, $data);
		wp_redirect( home_url().'/profile/style' ); 
		exit;
	}


	/*
	public function register_post_type(){
		$args = array(
			'labels' => array(
				'name'              => 'Profile',
				'singular_name'     => 'Profile',
				'menu_name'         => 'User Profile',
				'all_items'         => 'User Profiles',
				'add_new'			=> 'Add New',
				'add_new_item'		=> 'Add New user profile',
				'edit_item'			=> 'Edit User Profile',
				'new_item'			=> 'New User Profile',
				'view_item'			=> 'View User Profile',
				'search_items'		=> 'Search User Profile',
				'not_found'			=> 'No user profiles found',
				'not_found_in_trash'=> 'No user profiles in trash',
				'parent_item_colon'	=> '',
				),
			'public' => true, 
			'exclude_from_search' => true,
			//'menu_icon' => admin_url() . '/images/wpspin_light.gif',
			'supports' => array(
				'title',
				'thumbnail',
				),
			);

		register_post_type($this->post_type, $args);

	}
	*/

} //end of class

