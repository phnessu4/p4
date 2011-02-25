<?php
/**
 * interface controller
 */
class core_controller{
	public $param =array();
	public $view = null;
	public $config = array();

	/***
	 * 默认执行方法
	 ***/
	public function execute(){}

	public function __construct() {
		$this->view = new ext_smarty();
	}

	/***
	 * 添加全局变量到模板
	 * @param array $config	全局变量设置 
	 * @return null
	 ***/
	public function set_config($config = null){
		if (!is_null($config)){
			$this->config = $config;
			$this->view->assign('_',$config );
		}
	}
	
	/***
	 * 传值给模板
	 * @param string	$name	名成
	 * @param string	$value	值
	 * @return mixed
	 ***/
	protected function set($name = null , $value = null) {
		if(!is_null($name)){
			$this->view->assign($name , $value);
		}
	}

	/***
	 * 显示模板,添加menu高亮
	 * @param string	$template 	模板名称
	 * @param string	$menu		菜单名称
	 * @param string	$active	菜单高亮css类
	 * @return mixed
	 ***/
	public function display($template = null , $menu = null , $active = 'active' ){
		$this->set('menu_'.$menu, $active);
		if (!is_null($template)) {
			return $this->view->display($template);
		}
	}
	
	/***
	 * 回馈json给前端ajax,传值错误
	 * @param array 	$data		数据
	 * @param bool	$is_err	是否错误
	 * @return null
	 ***/
	public function to_json(array $data) {
	    echo ext_tool::json_encode($data);
	}
	
}