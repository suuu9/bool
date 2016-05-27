<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/19
 * Time: 10:19
 */
define('ACC', true);
require('./include/init.php');

$user = new UserModel();

//自动验证
if(!$user->_validate($_POST)) {
    $msg = implode('<br />', $user->getErr());
    include(ROOT . 'view/front/msg.html');
    exit;
}

//检查用户名是否存在
if($user->checkUser($_POST['username'])) {
    $msg = '用户名已存在';
    include(ROOT . 'view/front/msg.html');
    exit;
}

//自动填充
$data = $user->_autoFill($_POST);

//自动过滤
$data = $user->_facade($data);

if($user->reg($data)) {
    $msg = '用户注册成功';
} else {
    $msg = '用户注册失败';
}

include(ROOT . 'view/front/msg.html');