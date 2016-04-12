<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 上午10:59
 * 程序入口文件
 */

header('Content-type:text/html;charset=utf-8');

require('./include/init.php');

log::write('你好');

print_r($_GET);

echo '你好';


