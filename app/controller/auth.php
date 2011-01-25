<?php
class app_controller_auth extends core_controller {
	public $param = array(
		'email'=>'',
		'password'=>'',
	);

	/**
	 * 登录
	 */
	public function login(){
		$valid = array(
			array('name'=>'email','valid'=>'email'),
			array('name'=>'password'),
		);
		$msg = json_decode(ext_tool::vaild_scheme($this->param,$valid));
		if ($msg->error) {
			echo $msg->msg;
			return false;
		}
		$user = new app_model_user();
		$user->email = $this->param['email'];
		$user->password = $this->param['password'];
		if($user->login()){
			setcookie("login", 1,time()+3600,'/');
			echo '登录成功';
		}else{
			echo '登录失败';
		}
	}

	/**
	 *
	 */
	public function register(){
		$valid = array(
			array('name'=>'email','valid'=>'email'),
			array('name'=>'password'),
		);
		$msg = json_decode(ext_tool::vaild_scheme($this->param,$valid));
		if ($msg->error) {
			echo $msg->msg;
			return false;
		}
		$user = new app_model_user();
		$user->email = $this->param['email'];
		$user->password = $this->param['password'];
		if($user->register()){
			echo '注册成功';
		}else{
			echo '注册失败';
		}
	}

	/**
	 * 登出
	 */
	public function logout(){
		setcookie("login", 0,time()+3600,'/');
	}

}
?>