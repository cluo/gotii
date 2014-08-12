<?php
/**
 * 入口文件
 * @author 吾爱 <carlton.cheng@foxmail.com>
 * @license http://opensource.org/licenses/mit-license.php
 */
error_reporting(E_ALL);

header("Content-Type:text/html;charset=utf-8");

ini_set("display_errors","1");
ini_set("html_errors","1");

define("IN_APP", TRUE);//定义IN_APP常量，用于被包含脚本的安全判断 
define("ROOT_PATH", __DIR__.'/../');//定义站点根目录常量
define("APP_PATH", ROOT_PATH . "/application");//定义应用目录常量

try {
    include ROOT_PATH . "/bootstrap/bootstrap.php"; 
} catch (\Exception $e) {
    echo "File:" . $e->getFile() . "<br/>";
    echo "Line:" . $e->getLine() . "<br/>";
    echo "Message:" . $e->getMessage() . "<br/>";
    $trace = $e->getTraceAsString();
    echo nl2br($trace);
    echo "<br/>内存占用：".round(xdebug_memory_usage()/1024,2)."kb,消耗时间：".round(xdebug_time_index()*1000,3)."ms";
}