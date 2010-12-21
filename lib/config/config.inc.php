<?php
function_exists('realpath') ? '' : die('function realpath not exists , cant define ROOT');
realpath(dirname(__FILE__)) ? '' : die('cant find the file realpath');

define('DS',DIRECTORY_SEPARATOR);
/* 框架根目录 */
define('ROOT',realpath(dirname(__FILE__) . DS . '..' . DS . '..' ));
define('LIB_ROOT',ROOT . DS . 'lib');
define('EXT_ROOT',LIB_ROOT . DS . 'plugins');
define('EXT_CLASS','.php');

/* 应用app路径(默认) */
defined('APP_ROOT') or define('APP_ROOT',ROOT . DS . 'app');
define('CONTROLLER_ROOT',APP_ROOT . DS . 'controller');
define('MODEL_ROOT',APP_ROOT . DS . '..' );

/* 扩展名 */
define('LOG_ENABLE',true);
define('LOG_ROOT',APP_ROOT . DS . 'data' . DS . 'log');
define('ERROR_404_PAGE', APP_ROOT . DS . 'web' . DS .'404.html');

/* 定义数据库 */
define('DB_HOST','localhost');  //数据库定位
define('DB_USER','root');       //数据库登录名
define('DB_PASS','ubuntu');     //数据库密码
define('DB_NAME','note');       //数据库名称
//define(DB_ENCODE,'UTF8');     //sql数据编码

/* 设置错误级别 */
define('DEBUG', 2);

if (DEBUG == 2) {
    error_reporting(E_ALL);
} elseif (DEBUG == 1) {
    error_reporting(E_ALL & ~E_NOTICE);
} else {
    error_reporting(E_ERROR | E_PARSE | E_USER_ERROR);
}

require_once 'constants.php';
?>