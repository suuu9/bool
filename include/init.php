<?php
/**
 * 初始化文件 init.php
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 上午11:02
 */
header("Content-type: text/html; charset=utf-8");
defined('ACC') || exit('ACC Denied');
//定义根目录 替换反斜杠 linux不支持反斜杠
define('ROOT',str_replace('\\','/',dirname(dirname(__FILE__))) . '/');
define('DEBUG', true);

//定义报错级别
if(defined('DEBUG')) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

//载入类文件
require(ROOT . 'include/lib_base.php');

function __autoload($class) {
    if(strtolower(substr($class, -5)) == 'model'){
        require(ROOT . 'model/' . $class . '.class.php');
    } else if(strtolower(substr($class, -4)) == 'tool') {
        require(ROOT . 'tool/' . $class . '.class.php');
    } else {
        require(ROOT . 'include/' . $class . '.class.php');
    }
}

//请求数据转义 $_GET\$_POST\$_COOKIE
$_GET = _addslashes($_GET);
$_POST = _addslashes($_POST);
$_COOKIE = _addslashes($_COOKIE);

//开启session
session_start();