<?php
define('ROOT_KEY', '/');

/**
 * 核心调度调用
 */
class core_dispatcher {
	//实例化
	private static $instance;
	//app配置列表,访问规则
	private static $applications;
	//分发url地址
	private static $uri;

	public function __construct($inifile = null){
	    if (is_null($inifile)) {
            $inifile = APP_ROOT . DS . 'application.ini';
        }

        /* 获取配置文件 */
        $this->applications = parse_ini_file($inifile, true);
    }

	/**
	 * 实例化
	 */
	public function instance (){
	    if(is_null(self::$instance)){
            self::$instance = new core_dispatcher();
        }
        return self::$instance;
    }

    /**
     * 调度
     */
    public function dispatcher($uri){
    	$chunks = parse_url($uri);
        $this->uri = $chunks['path'];

        /* 检查是否默认调用 */
        if ($this->uri == ROOT_KEY && array_key_exists(ROOT_KEY, $this->applications)) {
            $this->invoke(ROOT_KEY, $this->applications[ROOT_KEY]);
            exit;
        }

        /* 根据配置,转化为正则,验证url传参 */
        foreach ($this->applications as $application => $config) {
            $regex = "|^/?". str_replace('*', '?.*', $application) . "$|";
            /* 正则匹配url */
            if (preg_match($regex, $this->uri)) {
                $this->invoke($application, $config);
                exit;
            }
        }
        /* 如不匹配,返回404 */
        $this->error_404();
    }


    /**
     * 调用
     */
    private function invoke($application, $config){
    	/* 检查默认cotroller是否存在 */
    	if (empty($config['method'])) {
    		trigger_error("No controller configured for the application "
                . $application, E_USER_ERROR);
    	}

    	/* 过滤uri,切割 */
        $request = split('/',preg_replace('#^/|/$#', '', $this->uri));
        $controller = &array_shift($request);
        $method = &array_shift($request);
        $params = &$request;
        
        if(empty($method)){
        	$method = $config['method'];
        }
        
    	$r = $this->_params($config, &$params);
    	dpx($r);

    }
    
    /**
     * 参数
     */
    function _params($config, &$params) {
        if (isset($config['params'])) {
            $keys = split(',', $config['params']);
            
            for ($i = 0, $l = count($params); $i < $l; $i++) {
                if (!empty($params[$i])) {
                    list($type, $name) = split(' ', trim($keys[$i]));
                    $value = urldecode(trim($params[$i]));
                    dbx($value);
                    
                    if (!$this->_validate_param(trim($type), $value)) {
                        $this->error_404();
                    }
                
                    $_GET[trim($name)] = $value;
                }
            }
        }
    }
    
    /**
     * 验证参数类型
     */
    private function _validate_param($type, $value) {

        if ($type == 'mixed') {
            return true;
        }

        return $type == 'int' && is_numeric($value)
        	|| $type == 'string' && is_string($value)
        	|| $type == 'array' && is_array($value);
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