<?php
function_exists('realpath') ? '' : die('function realpath not exists , cant define ROOT');
realpath(dirname(__FILE__)) ? '' : die('cant find the file realpath');

define('URL', 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . $_SERVER['REQUEST_URI'] );

/* 核心库目录路径定义 */
define('DS',DIRECTORY_SEPARATOR);
/* 框架根目录 */
define('ROOT',realpath(dirname(__FILE__) . DS . '..' . DS . '..' ));
/* 核心库路径 */
define('LIB_ROOT',ROOT . DS . 'lib');
/* 第三方库路径 */
define('EXT_ROOT',ROOT . DS . 'ext');
/* 数据路径 */
define('DATA_ROOT',ROOT . DS . 'data');

/* 应用app路径(默认) */
defined('APP_ROOT') or define('APP_ROOT',ROOT . DS . 'app');
defined('CONTROLLER_ROOT') or define('CONTROLLER_ROOT',APP_ROOT . DS . 'controller');
defined('MODEL_ROOT') or define('MODEL_ROOT',APP_ROOT . DS . 'model');
/* 日志路径 */
define('LOG_ROOT',APP_ROOT . DS . 'data' . DS . 'log');

/* 扩展名 */
define('EXT_CLASS','.php');
/* 是否开启日志 */
define('LOG_ENABLE',true);

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

defined('P4_LOADED') ? exit : define('P4_LOADED',1);
define('ERROR_404_PAGE', APP_ROOT . DS . 'web' . DS .'404.html');

require_once 'constants.php';
?>