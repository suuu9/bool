<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/13
 * Time: 11:51
 */

define('ACC', true);
require('../include/init.php');

$goods = new GoodsModel();
$_POST['goods_weight'] *= $_POST['weight_unit'];

$data = array();
$data = $goods->_facade($_POST);
$data = $goods->_autoFill($data);

if(!$goods->_validate($data)) {
    echo '数据不合法<br />';
    echo implode(',', $goods->getErr());
}

if($goods->add($data)) {
    echo '商品发布成功';
} else {
    echo '商品发布失败';
}

