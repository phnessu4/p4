<?php
class core_dispatcher {
	private static $instance;
	private static $applications;

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
     * 分发请求
     */
    public function dispatcher($uri){
    	$chunks = parse_url($uri);
    	dbx($chunks);
        $this->url = $chunks['path'];

    	dbx($uri);
    	dbx($this->applications);
    	dbx(APPLACTION_NAME);
    }
}
?>