<?php
/**
 * @author phnessu4 phnessu4@gmail.com
 * @copyright stylejar.com
 */
define('APPLACTION_NAME','p4_blog');
define('APP_ROOT',realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR .'..' ));
require_once('../../lib/config.inc.php');
core_dispatcher::instance()->dispatcher($_SERVER['REQUEST_URI']);
//http://samuelsjoberg.com/archive/2007/01/url-dispatcher

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
?>