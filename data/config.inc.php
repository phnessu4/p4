<?php
/**
* 路径设置
*
**/
$url    ='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
$doc_root =$_SERVER["DOCUMENT_ROOT"].dirname($_SERVER['PHP_SELF']);

define('URL',$url);
define('DOC_ROOT','/opt/projects/p4');
define('DB_HOST','localhost');  //数据库定位
define('DB_USER','root');       //数据库登录名
define('DB_PASS','ubuntu');     //数据库密码
define('DB_NAME','note');       //数据库名称
//define(DB_ENCODE,'UTF8');     //sql数据编码

spl_autoload_register(null, false);
spl_autoload_extensions(".php,inc.php"); // comma-separated list
spl_autoload_register('classLoader');

/*** class Loader ***/
function classLoader($class) {
	try {
	    $path = str_replace('_','/',strtolower($class));
		$file = DOC_ROOT.'/lib/' . $path.'.php';
		if (!file_exists($file)){
	        throw new Exception('cant find '.$file);
		}
		include $file;
	} catch (Exception $e) {
		dbx($e->getMessage());
	}
}

function dbx($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function dpx($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function dbt($var) {
    echo "<textarea cols=20 rows=6>";
    print_r($var);
    echo "</textarea>";
}


$view = new view_smarty();
?>