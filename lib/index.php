<?php
/**
 * 框架入口
 */
require_once 'config/config.inc.php';

function_exists('spl_autoload_register') ? '' : die('SPL not installed');

/* 加载原始autoload */
if(function_exists('__autoload')){
	spl_autoload_register('__autoload');
}

/* 加载loader */
spl_autoload_extensions(EXT_CLASS); // comma-separated list
spl_autoload_register('classLoader');

function classLoader($class) {
	/* 类名转路径 */
	$path = str_replace('_',DS,strtolower($class));
	//echo $class . "    $path<br />";
	
	$lib_file = LIB_ROOT . DS . $path . EXT_CLASS;
	$model_file = MODEL_ROOT . DS . $path . EXT_CLASS;

	file_exists($lib_file) ? $file = $lib_file : '';
	file_exists($model_file) ? $file = $model_file : '';
	
	if (!isset($file)){
		core_log::error('cant find '.$class);
		exit;
	}
	
	include $file;
}
?>