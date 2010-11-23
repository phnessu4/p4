<?php
require_once('../lib/config.inc.php');

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
		$r = $db->query($sql);
		$view->assign('action','update');
		$view->assign('post',$r[0]);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}

$view->display('index.html');
?>