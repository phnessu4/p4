<?php
/**
* 功能:数据库的基础操作类
*/
class db
{
	private $conn = "";	//句柄

	/**
	* 功能:初始话构造函数,数据库连接
	*/
	public function Con()
	{
		try{
			$conn = mysql_connect(DB_HOST, DB_USER, DB_PASS);	//链接数据库
		}catch(Exception $e){
			die($e->getMessage());
		}
		try{
			mysql_select_db(DB_NAME,$conn);	//选择数据库
		}catch(Exception $e){
			die($e->getMessage());
		}
		try{
			mysql_query("SET NAMES UTF8");
		}catch(Exception $e){
			die($e->getMessage());
		}
		$this->conn = $conn;
	}

	/**
	* 功能:释放数据库连接
	**/
	public function Decon()
	{
		@mysql_close($this->conn);
	}

	/**
	* 功能:数据库查询函数
	* 参数:$sql (sql语句)
	* 返回:二唯数组或false
	*/
	public function Query($sql)
	{
		if(empty($sql) || empty($this->conn)){
			return false;
		}
		try{
			$query = mysql_query($sql,$this->conn);	//请求数据库
		}catch(Expection $e){
			die($e->getMessage());
		}
		if((!$query) && empty($query)){
			@mysql_free_result($query);		//失败,施放内存,返回false
			return false;
		}else{
			$id = 0;
			while($row = mysql_fetch_assoc($query)){
					$result[$id] = $row;
					$id++;
			}
			@mysql_close($this->conn);
			return $result;
		}
	}

	/**
	* 功能:数据库插入数据
	* 参数:$sql (sql语句)
	* 返回:true或false
	*/
	public function Select($sql)
	{
		if(empty($sql) || empty($this->conn)){
			return false;
		}
		try{
			$query = mysql_query($sql,$this->conn);	//请求数据库
		}catch(Expection $e){
			die($e->getMessage());
		}
		return $query;
	}

	/**
	* 功能:数据库插入数据
	* 参数:$sql (sql语句)
	* 返回:true或false
	*/
	public function Insert($sql)
	{
		if(empty($sql) || empty($this->conn)){
			return false;
		}
		try{
			echo $sql;
			$query = mysql_query($sql,$this->conn);	//请求数据库
		}catch(Expection $e){
			die($e->getMessage());
		}
		return $query;
	}

	/**
	* 功能:数据库插入数据
	* 参数:$sql (sql语句)
	* 返回:true或false
	*/
	public function Update($sql)
	{
		if(empty($sql) || empty($this->conn)){
			return false;
		}
		try{
			echo $sql;
			$query = mysql_query($sql,$this->conn);	//请求数据库
		}catch(Expection $e){
			die($e->getMessage());
		}
		return $query;
	}

	/**
	* 功能:数据库删除数据
	* 参数:$sql (sql语句)
	* 返回:true或false
	*/
	public function Delete($sql)
	{
		if(empty($sql) || empty($this->conn)){
			return false;
		}
		try{
			$query = mysql_query($sql,$this->conn);	//请求数据库
		}catch(Expection $e){
			die($e->getMessage());
		}
		return $query;
	}

}
?>