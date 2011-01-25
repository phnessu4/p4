<?php
/**
 * interface controller
 */
class core_controller{
	public $param =array();
	public $view = null;

	/**
	 *
	 */
	public function execute(){

	}

	/**
	 *
	 */
	public function __construct() {
		$this->view = new ext_smarty();
	}
}