<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/23
 * Time: 16:34
 */

define('ACC', true);
require('./include/init.php');

session_destroy();

$msg = '退出成功';
include(ROOT . 'view/front/msg.html');