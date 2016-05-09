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

$testModel = new TestModel();

$result = $testModel->reg(array('title'=>'titletest', 'content'=>'contenttitle'));

var_dump($result);


