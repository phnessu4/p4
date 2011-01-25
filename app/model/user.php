<?php
/**
 * 用户model
 */
class app_model_user extends core_model {
	protected $table = 'user';

	public $email;
	public $password;

	public function login(){
		$sql = "select * from {$this->table} where `email` = '{$this->email}' and `password` = MD5('{$this->password}')";
		return $this->query($sql);
	}

	public function register(){
		if($this->is_regiseter()){
			return false;
		}
		$sql = "insert into {$this->table} (`email`, `password`) values ( '{$this->email}' , MD5('{$this->password}') )";
		return $this->execute($sql);
	}

	/**
	 *
	 */
	public function is_regiseter(){
		$sql = "select * from {$this->table} where `email` = '$this->email'";
		$result = $this->query($sql);
		if(empty($result)){
			return false;
		}
		return true;
	}

}
?>