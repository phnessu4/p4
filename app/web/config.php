<?php
/* 定义数据库 */
define ( 'DB_HOST', 'localhost' ); //数据库定位
define ( 'DB_USER', 'root' ); //数据库登录名
define ( 'DB_PASS', 'ubuntu' ); //数据库密码
define ( 'DB_NAME', 'note' ); //数据库名称
//define(DB_ENCODE,'UTF8');     //sql数据编码
define ( 'LOG_ENABLE', true );
/* 设置错误级别
 * default	E_ERROR | E_PARSE | E_USER_ERROR
 * 1			E_ALL & ~E_NOTICE
 * 2			E_ALL
 * */
define ( 'DEBUG', 2 );
?>