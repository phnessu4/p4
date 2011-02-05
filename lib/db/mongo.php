<?php
/**
 * mongo数据库操作类
 * @author c
 *
 */
class DB_Mongo{

    protected $con;
    protected $db;
    protected $collection;

    /**
     * 初始化连接
     */
    public function __construct(){
        $host = '127.0.0.1';
        $port = 27017;
        $db = 'mongo';
        $collection = 'user';

        $this->con = new Mongo("$host:$port");
        $this->db = $this->con->selectDB($db);
        self::setCollection($collection);
    }

    /**
     * 设置collection容器
     */
    public function setCollection($collection){
        if(!empty($collection)){
            $this->collection = $this->db->selectCollection($collection);
        }else{
            return false;
        }
    }

    /**
     * 插入数据
     */
    public function insert($data){
    	$ok = $this->collection->insert($data);
        self::msg($ok);
    }

    /**
     * 删除数据
     */
    public function delete($query){
        $ok = $this->collection->remove($query);
        self::msg($ok);
    }

    /**
     * 根据条件查询
     */
    public function find($query = array()){
        $result = array();

        $array = $this->collection->find($query);
        //$this->con->forceError();
        foreach ($array as $k=>$v) {
        	$tmp = &$result[];
            $tmp = $v;
            $tmp['_id'] = (string) $v['_id'];
        }
        return $result;
    }

    /**
     * 查询单条数据
     */
    public function findOne($query = array()){
        return $this->collection->findOne($query = array());
    }

    /**
     * 错误信息
     */
    public function msg($ok){
        if($ok){
            echo "insert ok \n";
        }else{
            echo "insert fail \n";
        }
    }

    /**
     * 错误信息
     */
    public function count(){
    	return $this->collection->count();
    }
}
?>