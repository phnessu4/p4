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
	private $rules;
	//分发url地址
	private $path = ROOT_KEY;
	//url转换的请求
	private $request;

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
    public function run($uri) {
		$this->parse_path($uri);
		$this->parse_invoke();
	}

	/**
	 * 解析uri,转换为请求地址
	 */
	private function parse_path($uri) {
    	$chunks = parse_url($uri);
		$path =  $chunks['path'];
        if ($path != ROOT_KEY) {
	        $this->request = split('/',preg_replace('#^/|/$#', '', $path));
	        $this->path = $this->request[0];
        }
	}

	/**
	 * 解析rules规则,触发invoke
	 */
	private function parse_invoke() {
		/* 检查是否默认调用 */
        if (array_key_exists($this->path, $this->rules)) {
        	try {
            	$this->invoke($this->path, $this->rules[$this->path]);
        	} catch (Exception $e) {
        		core_log::error($e->getMessage());
        	}
            exit;
        }
        $this->error_404();
	}

    /**
     * 调用
     */
    private function invoke($path, $rules){

    	/* 检查默认cotroller ,method是否存在 */
    	if (empty($rules['controller'])) {
    		throw new Exception("默认配置缺少 controller , 错误地址 : " . URL, E_USER_ERROR);
    	}
    	if (empty($rules['method'])) {
    		throw new Exception("默认配置缺少 method , 错误地址 : " . URL, E_USER_ERROR);
    	}

    	/* 验request中的值,赋值或根据配置文件初始化值 */
        $controller = isset($this->request[0]) ? array_shift($this->request) : $rules['controller'];
        $method 	= isset($this->request[0]) ? array_shift($this->request) : $rules['method'];
        $param 	= isset($this->request) ? $this->request : null;

    	/* 引用controller,动态调用方法 */
		require_once( APP_ROOT . DS . 'controller' . DS . $controller . EXT_CLASS);
        $class = 'app_controller_'.basename($controller);
        $controller = &new $class();

		if (is_subclass_of($controller, 'app_controller') == false) {
			throw new Exception('无效的 controller : '. $_SERVER['REQUEST_METHOD'], E_USER_ERROR);
        }

        /* 校验controller 中 method是否存在 ,不存在则使用默认方法*/
        if(method_exists($controller,$method) == false) {
        	$method = $rules['method'];
        }
		$controller->param = $this->_param($param);
        $controller->$method();
    }

    /**
     * 将url解析,合并到参数中,参数覆盖的优先级 url > post > get
     */
    private function _param($param) {
    	$result = array_merge($_GET,$_POST);
    	for ($i = 0; $i < count($param); $i += 2) {
    		if(isset($param[$i]) && isset($param[$i+1])){
	    		$name  = urldecode(trim($param[$i]));
	    		$value = urldecode(trim($param[$i+1]));
	    		$result[$name] = $value;
    		}
    	}
    	return $result;
    }

    /**
     *	error 404
     */
    private function error_404(){
	    @header("HTTP/1.0 404 Not Found");
        include(ERROR_404_PAGE);
        exit;
    }
}
?>