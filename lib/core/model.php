<?php
class core_model {

	public $db;

	/**
	 *
	 */
	public function __construct(){
		$this->db = new db_mysql;
	}
}
?>