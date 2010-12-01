<?php
/**
 * 日志
 */
class core_log {
	const ERROR = 0;
	const WARNING = 1;
	const NOTICE = 2;
	const DEBUG = 3;
	const ACCESS = 4;

	public static $log_path = LOG_ROOT;
	public static $log_enabled	= LOG_ENABLE;
	public static $log_date_format = 'Y-m-d H:i:s';

	/**
	 * 正常日志
	 */
	public function access($msg){
		self::do_log($msg, self::ACCESS);
	}

	/**
	 * 严重错误
	 */
	public function error($msg){
		self::do_log($msg, self::ERROR);
	}

	/**
	 * 警告
	 */
	public function warning($msg){
		self::do_log($msg, self::WARNING);
	}

	/**
	 * notice
	 */
	public function notice($msg){
		self::do_log($msg, self::NOTICE);
	}

	/**
	 * 调试
	 */
	public function debug($msg){
		self::do_log($msg, self::DEBUG);
	}

	/**
	 *
	 */
	public function do_log($msg, $level){
		if (self::$log_enabled == false || isset($level) == false) {
			return false;
		}

		if ($level == self::ACCESS) {
			$filepath = self::$log_path. DS .'log-'.date('Y-m-d').'.log';
		}else{
			$filepath = self::$log_path. DS.'error.log';
		}

		if ( ! $fp = fopen($filepath, FOPEN_WRITE_CREATE)) {
			return false;
		}

		$msg = date(self::$log_date_format)  ."  $msg" ;
		if (is_callable('xdebug_call_class')) {
		    $msg .= PHP_EOL . '  ' . xdebug_call_class() . ':' . xdebug_call_function() . '@' .
		    	xdebug_call_file() . '  line  ' .xdebug_call_line() . PHP_EOL ;
		}

		flock($fp, LOCK_EX);
		fwrite($fp, $msg);
		flock($fp, LOCK_UN);
		fclose($fp);

		chmod($filepath, FILE_WRITE_MODE);
		return true;
	}

}