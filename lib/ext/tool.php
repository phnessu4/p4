<?php
class ext_tool {

    /**
     * 验证email
     */
    public static function is_email($str) {
        return preg_match ( "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $str );
    }

    /**
     * 验证url是否合法
     */
    public static function is_url($str) {
        return preg_match ( "/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $str );
    }

    /**
     * form表单验证元素是否为空
     * @example vaild_scheme(array('name','title'=>'has_title') ,array('name','title' ) )  return false
     * @example vaild_scheme(array('name'=>'has_name','title'=>'has_title') ,array('name','title' ) )  return true
     * @param array	$data	form表单
     * @param array	$scheme	基本元素
     * @return true or false 为空返回1,通过返回0
     */
    public static function vaild_scheme($data, $scheme) {
        foreach ( $scheme as $v ) {
            $name = $v ['name'];
            $info = isset ( $data [$name] ) ? $data [$name] : null;
            if (is_null($info)) {return "{$name} 不存在,数据不能为空";}
            $valid = isset ( $v ['valid'] ) ? $v ['valid'] : null;
            $error = false;
            switch ($valid) {
                case 'url' :
                    self::is_url ( $info ) ? '' : $error = true;
                    break;
                case 'email' :
                    self::is_email ( $info ) ? '' : $error = true;
                    break;
                case 'int' :
                    is_numeric ( $info ) ? '' : $error = true;
                    break;
                case 'array' :
                    is_array ( $info ) ? '' : $error = true;
                    break;
                default :
                    break;
            }
            if ($error) {return "{$name} : {$info} 验证失败,类型不符合类型 {$valid}";}
        }
        return;
    }

    public static function json_encode($str) {
        $json = json_encode ( $str );
        //linux
        return preg_replace ( "#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))", $json );
         //windows
    //return preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2LE', 'UTF-8', pack('H4', '\\1'))", $json);
    }
}
?>