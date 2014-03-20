<?php

require_once 'db.php';

class Users_model extends db{


	public function __construct(){
		parent::__construct();
	}

	public function createUser($email, $password) {
		debug_log("Creating new user ".__FILE__."::".__LINE__);
		//This is a new user and member
		$username = $email;
		$password = $password;
		$res = wp_create_user( $username, $password, $email );
		return $res;
	}

}