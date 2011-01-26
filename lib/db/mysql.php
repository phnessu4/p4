<?php
/**
* 功能:数据库的基础操作类
*/
class db_mysql
{
	private $connect = NULL;

	public function __construct(){
		$connect = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		if (mysql_errno()) {
			throw new Exception(mysql_error());
		}
		mysql_select_db(DB_NAME,$connect);
		mysql_query("SET NAMES UTF8");
		$this->connect = $connect;
	}

    public function __destruct(){
    	if ($this->is_connected()) {
			mysql_close($this->connect);
		}
		unset($this->connect);
	}

	protected function is_connected(){
		return isset($this->connect) ? true : false;
	}
	/**
	* 功能:数据库查询函数
	* 参数:$sql (sql语句)
	* 返回:二唯数组或false
	*/
	public function query ($sql = '')
	{
		if (!$sql) {
			throw new Exception('query for no sql');
		}
		if(!$this->is_connected()){
			throw new Exception('mysql not connected');
		}
		$query = mysql_query($sql,$this->connect);

		if (mysql_errno()) {
			throw new Exception(mysql_error());
		}
		if ($query) {
			$id = 0;
			$result = array();
			while($row = mysql_fetch_assoc($query)){
					$result[$id] = $row;
					$id++;
			}
			return $result;
		}
		@mysql_free_result($query);		//失败,施放内存,返回false
		return false;
	}

	/**
	* 数据库插入数据
	* @param	$sql (sql语句)
	* @return	true or false
	*/
	public function execute($sql = '')
	{
		if (!$sql) {
			throw new Exception('query for no sql');
		}
		if(!$this->is_connected()) {
			throw new Exception('mysql not connected');
		}
		mysql_query($sql,$this->connect);
		if (mysql_errno()) {
			throw new Exception(mysql_error());
		}
		return true;

	}
function __toString()
{
    return "";
}
}
?>