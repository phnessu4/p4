<?php
/**
 * 核心调度调用
 * @author	phnessu4	phnessu4@gmail.com
 */

define('ROOT_KEY', '/');

class core_dispatcher {
	//实例化
	private static $instance;
	//app配置列表,访问规则
	private static $rules;
	//分发url地址
	private static $uri;
	//url转换的请求
	private static $request;

	public function __construct($inifile = null) {
	    if (is_null($inifile)) {
            $inifile = APP_ROOT . DS . 'rules.ini';
        }

        /* 获取配置文件 */
        $this->rules = parse_ini_file($inifile, true);
    }

	/**
	 * 实例化
	 */
	public function instance () {
	    if(is_null(self::$instance)) {
            self::$instance = new core_dispatcher();
        }
        return self::$instance;
    }

    /**
     * 处理分发
     */
    public function dispatcher($uri) {
    	$chunks = parse_url($uri);
        $this->uri = $chunks['path'];

        /* 处理请求地址 */
        if ($this->uri == ROOT_KEY) {
        	$path = ROOT_KEY;
        } else {
	        $this->request = split('/',preg_replace('#^/|/$#', '', $this->uri));
	        $path = $this->request[0];
        }

    	/* 检查是否默认调用 */
        if (array_key_exists($path, $this->rules)) {
            $this->invoke($path, $this->rules[$path]);
            exit;
        }

        /* 如不匹配,返回404 */
        $this->error_404();
    }


    /**
     * 调用
     */
    private function invoke($path, $rules){

    	/* 检查默认cotroller是否存在 */
    	if (empty($rules['controller'])) {
    		trigger_error("No controller configured for the rules file "
                . $path, E_USER_ERROR);
    	}

    	/* 验request中的值,赋值或根据配置文件初始化值 */
        $controller = isset($this->request[0]) ? array_shift($this->request) : $rules['controller'];
        $method 	= isset($this->request[0]) ? array_shift($this->request) : $rules['method'];
        $params 	= isset($this->request) ? $this->request : null;

        //dbx($controller,$method,$params);	//TODO:调试参数

    	$this->_params($params);

    	/* 引用controller,动态调用方法 */
		require_once( APP_ROOT . DS . 'controllers' . DS . $controller . EXT_CLASS);
        $class = 'app_'.basename($controller);
        $controller = &new $class();

        /* 校验controller 中 method是否存在 */
        if(method_exists($controller,$method) == false){
        	echo "method $method not exists";	//TODO:remove this line
        	$method = $rules['method'];
        }
        $controller->$method();

        if (is_subclass_of($controller, 'app_controller')) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $controller->do_get();
                    break;
                case 'POST':
                    $controller->do_post();
                    break;
                default:
                    trigger_error('Unhandled request method: '.
                        $_SERVER['REQUEST_METHOD'], E_USER_ERROR);
            }
        }
    }

    /**
     * 将url解析到get参数中
     */
    private function _params($params) {
    	if (empty($params)) {
    	}
    	for ($i = 0; $i < count($params); $i += 2) {
    		if(isset($params[$i]) && isset($params[$i+1])){
	    		$name  = urldecode(trim($params[$i]));
	    		$value = urldecode(trim($params[$i+1]));
    			$_GET[$name] = $value;
    		}
    	}
    }

    /**
     *	error 404
     */
    private function error_404(){
	    @header("HTTP/1.0 404 Not Found");
	    echo '文件没有找到';
        //include(FILE_NOT_FOUND);
        exit;
    }
}
?>