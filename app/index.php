<?php
require_once('../data/config.inc.php');

//$smarty->compile_check = true;
//$smarty->debugging = true;
$list = new db_mysql;
$sql = 'SELECT * FROM `notes`';
dpx($sql);
$r = $list->query($sql);
$smarty->assign('list',$r);

if(isset($_GET['id'])){
	$id = (int) $_GET['id'];
	$post = new db_mysql;
	$sql = "SELECT * FROM `notes` WHERE `id` = $id";
	$r = $post->query($sql);
	$smarty->assign('action','update');
	$smarty->assign('post',$r[0]);
}
$smarty->display('index.html');
?>