<?php
/**
 * 框架入口
 */
require_once 'config.inc.php';

function_exists('spl_autoload_register') ? '' : die('SPL not installed');

/* 加载原始autoload */
if(function_exists('__autoload')){
	spl_autoload_register('__autoload');
}

/* 加载loader */
spl_autoload_extensions(".php"); // comma-separated list
spl_autoload_register('classLoader');

function classLoader($class) {
	/* 类名转路径 */
	$path = str_replace('_',DS,strtolower($class));
	$file = LIB_ROOT . DS . $path . '.php';
	if (!file_exists($file)){
		die('cant find '.$file);
	}
	include $file;
}
?>