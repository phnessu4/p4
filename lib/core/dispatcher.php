<?php
class core_dispatcher {
	private static $instance;
	
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
    	dbx($uri);
    }
}
?>