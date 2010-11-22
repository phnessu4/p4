<?php
require_once('../data/config.inc.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$title   = strip_tags($_POST['title']);
	$content = strip_tags($_POST['content']);
	$id = strip_tags($_POST['id']);
	$action = strip_tags($_POST['action']);

	$note = new db_mysql;
	if($action == 'update'){
	$sql = "UPDATE `note`.`notes` SET `title` =  '$title',`content` = '$content' WHERE `notes`.`id` =$id";
		if( $note->execute($sql) ){
			echo '提交成功';
		};
	}else{
	$sql = "INSERT INTO `note`.`notes` (`id`,`title`, `content`, `time`) VALUES ( '$id','$title', '$content', NOW());";
		if( $note->execute($sql) ){
			echo '提交成功';
		};
	}
}
?>