<?php
//模板路径
define('TPL_ROOT',APP_ROOT .DS . 'data' . DS .'tpl');
define('TPL_C_ROOT',APP_ROOT .DS . 'data' . DS .'tpl_c');
define('CACHE_ROOT',APP_ROOT .DS . 'data' . DS .'cache');
define('TPL_CFG_ROOT',APP_ROOT .DS . 'data' . DS .'tpl_cfg');

/**
* SMARTY模板设置
*
**/
require_once(ROOT . DS . 'plugins' . DS . 'Smarty'.DS.'Smarty.class.php');

class ext_smarty extends Smarty{
	public $debug = false;
	public $compile = false;
	/**
	 *
	 */
	public function __construct() {
		$this->template_dir = TPL_ROOT;
		$this->compile_dir = TPL_C_ROOT;
		$this->cache_dir = CACHE_ROOT;
		$this->config_dir = TPL_CFG_ROOT;
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