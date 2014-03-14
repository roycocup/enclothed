<?php

class db {

	public $table = '';
	public $wpdb;




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


	public function fieldExists($table, $field){
		$sql = "SELECT TABLE_NAME 
				FROM information_schema.COLUMNS 
				WHERE 
				TABLE_NAME = '{$table}' 
				AND COLUMN_NAME = '{$field}'";
		return $this->wpdb->get_var($sql);
	}

}