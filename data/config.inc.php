<?php
/**
* 路径设置
*
**/
$url    ='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
$doc_root =$_SERVER["DOCUMENT_ROOT"].dirname($_SERVER['PHP_SELF']);

define('URL',$url);
define('DOC_ROOT','/opt/projects/p4');

/**
* SMARTY模板设置
*
**/
require_once(DOC_ROOT.'/ext/Smarty/Smarty.class.php');

$smarty = new Smarty();             //模板对象
$smarty->template_dir = DOC_ROOT.'/data/templates';      //模板文件
$smarty->compile_dir = DOC_ROOT.'/data/templates_c';
$smarty->cache_dir = DOC_ROOT.'/data/cache';
$smarty->config_dir = DOC_ROOT.'/data/config';


/**
* 数据库基本设置
*
**/
define('DB_HOST','localhost');  //数据库定位
define('DB_USER','root');       //数据库登录名
define('DB_PASS','ubuntu');     //数据库密码
define('DB_NAME','note');       //数据库名称
//define(DB_ENCODE,'UTF8');     //sql数据编码

spl_autoload_register(null, false);
spl_autoload_extensions(".php,inc.php"); // comma-separated list
spl_autoload_register();

	/*** class Loader ***/
    function classLoader($class)
    {
        $filename = strtolower($class) . '.php';
        $file =DOC_ROOT.'/lib/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        //dbx($file);	//TODO:	debug file path
        include $file;
    }

    /*** register the loader functions ***/
    spl_autoload_register('classLoader');

function dbx($var){
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function dpx($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function dbt($var){
    echo "<textarea cols=20 rows=6>";
    print_r($var);
    echo "</textarea>";
}

?>