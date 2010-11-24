<?php
//核心库目录路径定义
if (function_exists('realpath') AND @realpath(dirname(__FILE__)) !== FALSE){
	define('DS',DIRECTORY_SEPARATOR);
	//框架根目录
	define('ROOT',realpath(dirname(__FILE__) . DS .'..' ));
	//核心库路径
	define('LIB_ROOT',ROOT . DS . 'lib');
	//第三方库路径
	define('EXT_ROOT',ROOT . DS . 'ext');
	//数据路径
	define('DATA_ROOT',ROOT . DS . 'data');

	//应用app路径(默认)
	defined('APP_ROOT') or define('APP_ROOT',ROOT . DS . 'app');

	/**
	 * Constant denoting the error reporting level.
	 * 0 - Show errors only.
	 * 1 - Show warnings and errors.
	 * 2 - Show notices, warnings and errors.
	 */
	define('DEBUG', 1);

	//定义数据库
	define('DB_HOST','localhost');  //数据库定位
	define('DB_USER','root');       //数据库登录名
	define('DB_PASS','ubuntu');     //数据库密码
	define('DB_NAME','note');       //数据库名称
	//define(DB_ENCODE,'UTF8');     //sql数据编码

}else{
	die('function realpath not exists , cant define ROOT');
}

spl_autoload_extensions(".php,inc.php"); // comma-separated list
spl_autoload_register('classLoader');

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