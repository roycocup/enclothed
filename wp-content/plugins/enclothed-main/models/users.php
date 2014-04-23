<?php

require_once 'db.php';

class Users_model extends db{


	public function __construct(){
		parent::__construct();
	}

	public function createUser($email, $password, $extra = '') {
		debug_log("Creating new user ".__FILE__."::".__LINE__);
		//This is a new user and member
		$username = $email;
		$password = $password;
		$duplicateEmail = email_exists( $email );
		if (!$duplicateEmail) {
			$id = wp_create_user( $username, $password, $email );

			//include other things 
			if (!empty($extra) && is_int($id)){
				$update_array = array('ID'=>$id);
				$update_array = array_merge($update_array, $extra);
				wp_update_user( $update_array );
			}
			return $id;
		} else {
			//Return email already exists
			return new WP_Error( 'existing_user_email', __( 'Sorry, that email address is already used!' ) );
		}
	}

}