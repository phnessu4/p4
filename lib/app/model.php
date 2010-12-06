<?php
class app_model {
	
	public $db;
	
	/**
	 * 
	 */
	public function __construct(){
		$this->db = new db_mysql;
	}
}
?>