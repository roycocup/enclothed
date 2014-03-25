<?php
require_once('db.php');


class Profiles_model extends db{

	public $profile_id = '';
	public $customer_id  = '';
	public $order_num_ref = '';
	public $first_name  = '';
	public $last_name  = '';
	public $email  = '';
	public $phone  = '';
	public $mobile = '';
	public $dob = '';
	public $occupation = '';
	public $other_person = '';
	public $other_person_name = '';
	public $referral = '';
	public $neck_size = '';
	public $tshirt_size = '';
	public $sleve_lenght = '';
	public $shoe_size = '';
	public $jacket_size = '';
	public $trouser_size = '';
	public $trouser_inside_leg_size = '';
	public $add_size_info = '';
	public $user_fit_brands = '';
	public $shirt_min_price = '';
	public $shirt_max_price = '';
	public $trouser_min_price = '';
	public $trouser_max_price = '';
	public $coat_min_price = '';
	public $coat_max_price = '';
	public $shoes_min_price = '';
	public $shoes_max_price = '';
	public $promotional_code = '';
	public $gift_card_code = '';

	public $table = 'wp_enc_profile';

	public function __construct(){
		parent::__construct();
	}

	public function save($data) {
		$this->replace($data, null, $this->table);
	}
}
