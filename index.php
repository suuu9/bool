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

for($i=0;$i<5000;$i++) {
    log::write('尝试将由 filename 给出的文件的访问和修改时间设定为指定的时间。
    如果没有设置可选参数 time，则使用当前系统时间。如果给出了第三个参数 atime，
    则指定文件的访问时间会被设为 atime 。');
}

echo '你好';


