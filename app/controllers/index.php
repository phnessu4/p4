<?php
/**
 * demo index
 */
class app_index extends app_controller{
	public $param = array();
	private $db;

	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
		$this->db = new db_mysql;
	}

	/**
	 *
	 */
	public function execute(){
		try {
			$sql = 'SELECT * FROM `notes`';
			$r =  $this->db->query($sql);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$this->view->assign('list',$r);
		$this->view->display('index.html');
	}

	/**
	 *
	 */
	public function edit(){
		if(isset($this->param['id'])){
			$id = (int) $this->param['id'];
			try {
				$sql = "SELECT * FROM `notes` WHERE `id` = $id";
				$r = $this->db->query($sql);
				$this->view->assign('action','update');
				$this->view->assign('post',$r[0]);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		$this->execute();
	}

	/**
	 *
	 */
	public function post(){
		$id = isset($this->param['id']) ? strip_tags($this->param['id']) : '';
		$title = isset($this->param['title']) ? strip_tags($this->param['title']) : '';
		$action = isset($this->param['action']) ? strip_tags($this->param['action']) : '';
		$content = isset($this->param['content']) ? strip_tags($this->param['content']) : '';

		if($action == 'update'){
			$sql = "UPDATE `note`.`notes` SET `title` =  '$title',`content` = '$content' WHERE `notes`.`id` =$id";
		}else{
			$sql = "INSERT INTO `note`.`notes` (`id`,`title`, `content`, `time`) VALUES ( '$id','$title', '$content', NOW());";
		}
		try {
			$this->db->execute($sql);
			echo '提交成功';
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
?>