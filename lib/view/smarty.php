<?php
/**
* SMARTY模板设置
*
**/
require_once(DOC_ROOT.'/ext/Smarty/Smarty.class.php');

class view_smarty extends Smarty{
	public $debug = false;
	public $compile = false;
	/**
	 *
	 */
	public function __construct() {
		$this->template_dir = DOC_ROOT.'/data/templates';      //模板文件
		$this->compile_dir = DOC_ROOT.'/data/templates_c';
		$this->cache_dir = DOC_ROOT.'/data/cache';
		$this->config_dir = DOC_ROOT.'/data/config';
	}
	/**
	 *
	 */
	public function debug() {
		$this->debugging = true;
	}
	/**
	 *
	 */
	public function compile() {
		$this->compile_check = true;
	}
}
?>