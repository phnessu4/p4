<?php
/**
* 功能:数据库的基础操作类
*/
class db_mysqli
{
	protected $mysqli ;

	public function __construct(){
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ( mysqli_connect_errno() ) {
			throw new Exception( mysqli_connect_error(). $this->mysqli->host_info);
		}
		$this->mysqli->set_charset('UTF8');
	}

    public function __destruct() {
    	if ($this->is_connected()) {
			$this->mysqli->close();
		}
	}

	protected function is_connected() {
		return $this->mysqli ? true : false;
	}

	/**
	* 功能:数据库查询函数
	* 参数:$sql (sql语句)
	* 返回:二唯数组或false
	*/
	public function query ($sql = '') {
		if (!$sql) {
			throw new Exception('query for no sql');
		}
		if( !$this->is_connected() ){
			throw new Exception('database not connect');
		}
		$result = $this->mysqli->query($sql);

		if ($this->mysqli->errno) {
			throw new Exception("SQL ERROR:". $this->mysqli->error .' SQL: '. $sql);
		}
		return $this->fetch_result_rows( $result );
	}

	/**
	* 数据库插入数据
	* @param	$sql (sql语句)
	* @return	true or false
	*/
	public function execute($sql = '') {
		if (!$sql) {
			throw new Exception('query for no sql');
		}
		if( !$this->is_connected() ){
			throw new Exception('database not connect');
		}
		$result = $this->mysqli->query($sql);

		if ($this->mysqli->errno) {
			throw new Exception("SQL ERROR:". $this->mysqli->error .' SQL: '. $sql);
		}
		return true;
	}

	/**
	 * 匹配结果数据
	 */
	private function fetch_result_rows($result, $mode=MYSQLI_ASSOC){
        $rows=array();
        while($row = $result->fetch_array($mode)){
            $rows[]=$row;
        }
        $result->close();
        return $rows;
    }

}
?>