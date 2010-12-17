<?php
/**
 * @author phnessu4 phnessu4@gmail.com
 * @copyright stylejar.com
 */

define('APPLACTION_NAME','p4_blog');
define('APP_ROOT',realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR .'..' ));

require_once('../../lib/index.php');
core_dispatcher::instance()->run($_SERVER['REQUEST_URI']);
//http://samuelsjoberg.com/archive/2007/01/url-dispatcher


function dbx() {
	echo '<pre>';
	if(func_num_args()){
		foreach (func_get_args() as $k => $v) {
			echo "------- dbx $k -------<br/>";
			print_r($v);
			echo "<br/>";
		}
	};
	echo '</pre>';
}

function dpx() {
    echo '<pre>';
	if(func_num_args()){
		foreach (func_get_args() as $k => $v) {
			echo "------- dbx $k -------<br/>";
			var_dump($v);
			echo "<br/>";
		}
	};
    echo '</pre>';
}

function dbt() {
    echo '<pre>';
	if(func_num_args()){
		foreach (func_get_args() as $k => $v) {
			echo "------- dbx $k -------<br/>";
			echo "<textarea cols=20 rows=6>";
			print_r($v);
			echo "</textarea>";
			echo "<br/>";
		}
	};
    echo '</pre>';

}
?>