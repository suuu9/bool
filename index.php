<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 上午10:59
 * 程序入口文件
 */

header('Content-type:text/html;charset=utf-8');

define('ACC', true);
require('./include/init.php');

//echo ImageTool::water('./45.jpg', './49.jpg', 'home1.jpg', 0) ? 'ok' : 'fail';
//echo ImageTool::water('./45.jpg', './49.jpg', 'home2.jpg', 1) ? 'ok' : 'fail';
//echo ImageTool::water('./45.jpg', './49.jpg', 'home3.jpg', 2) ? 'ok' : 'fail';
//echo ImageTool::water('./45.jpg', './49.jpg', 'home4.jpg', 3) ? 'ok' : 'fail';

//echo ImageTool::thumb('./45.jpg', 'test1.jpg', 200, 200) ? 'ok' : 'fail';
//echo ImageTool::thumb('./45.jpg', 'test2.jpg', 200, 300) ? 'ok' : 'fail';
//echo ImageTool::thumb('./45.jpg', 'test3.jpg', 200, 200) ? 'ok' : 'fail';

ImageTool::createCode();