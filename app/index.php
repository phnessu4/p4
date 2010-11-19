<?php
require_once('../data/config.inc.php');

//$smarty->compile_check = true;
//$smarty->debugging = true;
$list = new db;
$list->con();
$sql = 'SELECT * FROM `notes`';
$r = $list->Query($sql);
$smarty->assign('list',$r);

if(isset($_GET['id'])){
	$id = (int) $_GET['id'];
	$post = new DB;
	$post->con();
	$sql = "SELECT * FROM `notes` WHERE `id` = $id";
	$r = $post->Query($sql);
	$smarty->assign('action','update');
	$smarty->assign('post',$r[0]);
}
$smarty->display('index.html');
?>
