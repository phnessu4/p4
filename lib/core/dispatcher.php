<?php
define('ROOT_KEY', '/');

/**
 * core dispatcher invoke
 */
class core_dispatcher {
	//实例化
	private static $instance;
	//app配置列表,访问规则
	private static $applications;
	//分发url地址
	private static $url;

	public function __construct($inifile = null){
	    if (is_null($inifile)) {
            $inifile = APP_ROOT . DS . 'application.ini';
        }

        // Get the application configuration.
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
        $this->url = $chunks['path'];

        // Step 1. 检查是否默认调用
        if ($this->url == ROOT_KEY && array_key_exists(ROOT_KEY, $this->applications)) {
            $this->invoke(ROOT_KEY, $this->applications[ROOT_KEY]);
            exit;
        }

        // Search for an application to dispatch the request to.
        foreach ($this->applications as $application => $config) {
            $regex = "|^/?". str_replace('*', '?.*', $application) . "$|";
            if (preg_match($regex, $this->url)) {
                $this->invoke($application, $config);
                exit;
            }
        }
        $this->error_404();
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
     * 调用
     */
    private function invoke($application, $config){
    	if (empty($config['controller'])) {
    		trigger_error("No controller configured for the application "
                . $application, E_USER_ERROR);
    	}
    	//$this->_params($config, $this->_getValues($application));


    	dbx($application,$config,$this);
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