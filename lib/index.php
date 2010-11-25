<?php
require_once 'config.inc.php';
spl_autoload_extensions(".php"); // comma-separated list
spl_autoload_register('classLoader');

// Set level of error reporting
if (DEBUG == 2) {
    error_reporting(E_ALL);
} elseif (DEBUG == 1) {
    error_reporting(E_ALL & ~E_NOTICE);
} else {
    error_reporting(E_ERROR | E_PARSE | E_USER_ERROR);
}

/**
 * 路由
 */
function classLoader($class) {
	//类名转路径
	$path = str_replace('_',DS,strtolower($class));
	$file = LIB_ROOT . DS . $path . '.php';
	if (!file_exists($file)){
		die('cant find '.$file);
	}
	include $file;
}


?>