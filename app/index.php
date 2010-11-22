<?php
require_once('../data/config.inc.php');

try {
	$sql = 'SELECT * FROM `notes`';
	$db = new db_mysql;
	$r = $db->query($sql);
} catch (Exception $e) {
	echo $e->getMessage();
}	
$view->assign('list',$r);

if(isset($_GET['id'])){
	$id = (int) $_GET['id'];
	try {
		$sql = "SELECT * FROM `notes` WHERE `id` = $id";
		$db = new db_mysql;
		$r = $db->query($sql);
	} catch (Exception $e) {
		echo $e->getMessage();
	}	
	
	$view->assign('action','update');
	$view->assign('post',$r[0]);
}

$view->display('index.html');
?>