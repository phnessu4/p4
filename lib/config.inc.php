<?php
define('DS',DIRECTORY_SEPARATOR);

define('ROOT',realpath(dirname(__FILE__) ));
define('APP_MODEL',APP_ROOT . DS . '..' );
define('LOG_PATH',APP_ROOT . DS . 'data' . DS . 'log');
define('ERROR_404_PAGE', APP_ROOT . DS . 'web' . DS .'404.html');
define('EXT_CLASS','.php');

/* 定义数据库 */
define('DB_HOST','localhost');  //数据库定位
define('DB_USER','root');       //数据库登录名
define('DB_PASS','ubuntu');     //数据库密码
define('DB_NAME','note');       //数据库名称
//define(DB_ENCODE,'UTF8');     //sql数据编码

defined('LOG_ENABLE') or define('LOG_ENABLE',true);
/* 设置错误级别 */
defined('DEBUG') or define('DEBUG', 2);

if (DEBUG == 2) {
    error_reporting(E_ALL);
} elseif (DEBUG == 1) {
    error_reporting(E_ALL & ~E_NOTICE);
} else {
    error_reporting(E_ERROR | E_PARSE | E_USER_ERROR);
}

/* loger access url  */
define('URL', 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . $_SERVER['REQUEST_URI'] );

/**
 * File and Directory Modes
 * These prefs are used when checking and setting modes when working
 * with the file system.  The defaults are fine on servers with proper
 * security, but you may wish (or even need) to change the values in
 * certain environments (Apache running a separate process for each
 * user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
 * always be used to set the mode correctly.
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/**
 * File Stream Modes
 * These modes are used when working with fopen()/popen()
 */
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b');
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',	'x+b');

?>