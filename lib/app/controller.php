<?php
/**
 * applecation controller
 */
class app_controller extends core_controller {
	public $view = null;
	/**
	 *
	 */
	public function __construct() {
		$this->view = new ext_smarty();
	}

	/**
	 *
	 */
	public function do_get(){
		dpx($_GET);

	}
	/**
	 *
	 */
	public function do_post(){
		dbx($_POST);
	}
}
