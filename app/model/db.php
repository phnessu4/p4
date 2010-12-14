<?php
class app_model_db extends app_model{
	/**
	 *
	 */
	public function add_post($id,$title,$content){
		$sql = "INSERT INTO `note`.`notes` (`id`,`title`, `content`, `time`) VALUES ( '$id','$title', '$content', NOW());";
		return $this->db->execute($sql);
	}
	/**
	 *
	 */
	public function list_post(){
		$sql = 'SELECT * FROM `notes`';
		return  $this->db->query($sql);
	}
	/**
	 *
	 */
	public function update_post($id,$title,$content){
		$sql = "UPDATE `note`.`notes` SET `title` =  '$title',`content` = '$content' WHERE `notes`.`id` =$id";
		return $this->db->execute($sql);
	}
	/**
	 *
	 */
	public function get_post($id){
		$sql = "SELECT * FROM `notes` WHERE `id` = $id";
		return $this->db->query($sql);
	}
}
?>