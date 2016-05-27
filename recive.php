<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/27
 * Time: 15:42
 */
define('ACC', true);
require('./include/init.php');

//print_r($_POST);

$md5key = 'sfsadf!@#123456';
$md5info = md5($_POST['v_oid'] . $_POST['v_pstatus'] . $_POST['v_amount'] . $_POST['v_moneytype'] . $md5key);
$md5info = strtoupper($md5info);

if($md5info !== $_POST['v_md5str']) {
    echo '你想出老千';
    exit;
}

echo '执行sql语句，把订单号' . $_POST['v_oid'];
echo '对应的订单改为已支付';