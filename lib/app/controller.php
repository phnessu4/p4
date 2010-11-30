<?php
/**
 * applecation controller
 */
class app_controller extends core_controller {
	public  $view = null;

	/**
	 *
	 */
	public function __construct() {
		$this->view = new ext_smarty();
	}
}
