<?php

class db {

	public $table = '';
	public $wpdb;

	public $templates_table 	= 'wp_enc_email_templates'; 
	public $emails_table 		= 'wp_enc_emails';
	public $brands_table 		= 'wp_enc_brands';
	public $gifts_table 		= 'wp_enc_gifts';



	public function __construct(){
		global $wpdb;
		$this->wpdb = $wpdb; 
	}


	/**
	*
	* The order of the parameters is inverted so that table does not have to specified
	* when inside an object as $this->table will be assumed by default
	*
	**/
	public function insert($data, $table = ''){
		$table = (empty($table)) ? $this->table : $table;
		$now = date('Y-m-d H:i:s', time());
		$modified_exists = $this->fieldExists($table, 'modified');
		$created_exists = $this->fieldExists($table, 'created');

		if ($created_exists) $data['created'] = $now;
		if ($modified_exists) $data['modified'] = $now;
		$ok = $this->wpdb->insert($table, $data);
		if ($ok) return $this->wpdb->insert_id;
		return $ok;
	}

	/**
	*
	* The order of the parameters is inverted so that table does not have to specified
	* when inside an object as $this->table will be assumed by default
	*
	**/
	public function update($data, $where, $table = ''){
		$table = (empty($table)) ? $this->table : $table;
		$now = date('Y-m-d H:i:s', time());
		$modified_exists = $this->fieldExists($table, 'modified');
		if ($modified_exists) $data['modified'] = $now;

		$ok = $this->wpdb->update($table, $data, $where);
		return $ok;
	}


	/**
	*
	* This will replace which meand it tries to update the value and if does not exist, it will insert it. 
	*
	**/
	public function replace ($data, $where = '', $table = ''){
		$table = (empty($table)) ? $this->table : $table;
		
		//check that the value already exists (must be unique!)
		if (!empty($where)){
			$sql = "SELECT * FROM {$table} ";
			$sql .= " WHERE 1 "; 
			foreach ($where as $key => $value) {
				$sql .= ' AND ';
				$sql .= " `{$key}` = '{$value}' "; 
			}
			$record = $this->wpdb->get_results($sql);
		}
		
		if (!empty($record) && !empty($where)){
			//update
			$ok = $this->update($data, $where, $table);
			return $ok;	
		}else {
			//insert
			$id = $this->insert($data, $table);
			return $id;
		}

		
	}


	/**
	*
	* Does what it says on the tin really...
	*
	**/
	public function fieldExists($table, $field){
		$sql = "SELECT TABLE_NAME 
				FROM information_schema.COLUMNS 
				WHERE 
				TABLE_NAME = '{$table}' 
				AND COLUMN_NAME = '{$field}'";
		return $this->wpdb->get_var($sql);
	}


	/**
	*
	* Use this to get a prepared statement and safer query
	* parameters must be included in the sql as %s (string), %d (integer) and %f (float) 
	* and the parameters can be an array with the respective values in order
	* @param string $sql
	* @param array $params 
	* @return array of objects
	*
	**/
	public function query($sql, $params){
		$prep_stmt = $this->wpdb->prepare($sql, $params);
		$results = $this->wpdb->get_results($prep_stmt); 
		return $results;
	}

}