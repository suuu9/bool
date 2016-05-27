<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/23
 * Time: 15:43
 */

define('ACC', true);
require('./include/init.php');

if(isset($_POST['act']) && $_POST['act'] == 'act_login') {

    //获取数据
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    $user = new UserModel();
    $row = $user->checkUser($username, $passwd);
    if(empty($row)) {
        $msg = "用户名密码不匹配";
    } else {
        $msg = "登录成功";

        $_SESSION = $row;

        if(isset($_POST['remember'])) {
            setcookie('remuser', $username, time()+14*24*3600);
        } else {
            setcookie('remuser', '', 0);
        }
    }

    include(ROOT . 'view/front/msg.html');
    exit();

} else {
    $remuser = isset($_COOKIE['remuser']) ? $_COOKIE['remuser'] : '';
    include(ROOT . 'view/front/denglu.html');
}
