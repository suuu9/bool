<?php
/**
 * 初始化文件 init.php
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 上午11:02
 */

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
require(ROOT . 'include/db.class.php');
require(ROOT . 'include/conf.class.php');
require(ROOT . 'include/log.class.php');