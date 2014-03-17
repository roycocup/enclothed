<?php


require_once 'db.php';

class Brands_model extends db{

	public $table = 'wp_enc_brands';
	public $webservice_url = 'http://www.kimonolabs.com/api/9okk7v2c?apikey=3fbbb3ce98f9948df33a0252a2763cbf'; 

	public function __construct(){
		parent::__construct();
	}


	public function getBrands(){
		$response = file_get_contents($this->webservice_url);
		$results = json_decode($response, TRUE);
		return $results;
	}


	/**
	*
	* Returns a list of brands from the database
	*
	**/
	public function getBrandsList (){
		$sql = "SELECT * FROM {$this->table}"; 
		$rs = $this->wpdb->get_results($sql); 
		return $rs; 
	}	

	/**
	*
	* Returns an array of all brands on the online side
	* @return array of all brands 
	*
	**/
	public function getBrandsRemoteList(){
		$brands = $this->getBrands(); 
		foreach ($brands as $key => $value) {
			if ($key == 'results'){
				foreach ($value['collection1'] as $item) {
					$list[] = $item['list']['text']; 
				}
			}
		}
		return $list;
	}


	public function updateDbBrands($use_webservice = true, $manual_brands = array()){
		if ($use_webservice){
			//get brands array
			$all_brands = $this->getBrandsList();
			foreach ($all_brands as $brand) {
				//at this point we are only updating the name of the brand as we dont have any logos
				$aBrand['name'] = $brand; 
				$aBrand['img_url'] = get_stylesheet_directory_uri().'/default_brand.jpg';
				$this->updateBrand($aBrand); 
			}	
		}

		if (!empty($manual_brands)){
			foreach ($manual_brands as $brand) {
				$aBrand['name'] = $brand; 
				$aBrand['img_url'] = '';
				$this->updateBrand($aBrand); 
			}
		}
		
	}

	/**
	*
	* @var array - each brand is an array with the ['name', 'img_url'] 
	* @return bool
	*
	**/
	public function updateBrand ($brand){
		//somethings wrong
		if (empty($brand)) return false;

		$data['brand_name'] = $brand['name'];
		$data['brand_logo'] = $brand['img_url'];
		$where['brand_name'] = $brand['name'];

		$this->replace($data, $where, $this->table); 
	}



}


