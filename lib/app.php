<?php
class app {
	private $view = null;
	
	public function __construct(){
		$this->view = new view_smarty();
	}
}
?>