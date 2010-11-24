<?php
class view_app extends core_object{
	private $view = null;

	public function __construct(){
		$this->view = new view_smarty();
	}
}
?>