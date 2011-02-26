<?php

/**
 * 计算程序执行时间
 */
function getmicrotime() {
    list ( $usec, $sec ) = explode ( " ", microtime () );
    return (( float ) $usec + ( float ) $sec);
}
//开始
$time_start = getmicrotime ();
//这里放你的代码
//结束
$time_end = getmicrotime ();
$time = $time_end - $time_start;
echo "Did nothing in $time seconds"; //输出运行总时间
?>