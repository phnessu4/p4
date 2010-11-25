<?php
/**
 *
 */
class app_list extends app_controller{
	/**
	 *
	 */
	public function lists(){
		try {
			$sql = 'SELECT * FROM `notes`';
			$db = new db_mysql;
			$r = $db->query($sql);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$this->view->assign('list',$r);

		if(isset($_GET['id'])){
			$id = (int) $_GET['id'];
			try {
				$sql = "SELECT * FROM `notes` WHERE `id` = $id";
				$r = $db->query($sql);
				$this->view->assign('action','update');
				$this->view->assign('post',$r[0]);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}

		$this->view->display('index.html');
	}
}
?>