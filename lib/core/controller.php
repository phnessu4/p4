<?php
/**
 * interface controller
 */
class core_controller{
	public $param =array();
	public $view = null;
	public $config = array();

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

	/**
	 * 
	 */
	public function set_config($config = null){
		if (!is_null($config)){
			$this->config = $config;
			$this->view->assign('_',$config );
		}
	}

}