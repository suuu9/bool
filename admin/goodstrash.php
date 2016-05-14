<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/13
 * Time: 17:46
 */

/**
 * 回收站功能
 */
define('ACC', true);
require('../include/init.php');

if(isset($_GET['act']) && $_GET['act'] == 'show') {
    //这个部分是打印所有的回收商品
    $goods = new GoodsModel();
    $goodslist = $goods->getTrash();
    $act = $_GET['act'];

    include(ROOT . 'view/admin/admin_goods_list.php');
} else {
    $goods_id = $_GET['goods_id'] + 0;
    $goods = new GoodsModel();

    if($goods->trash($goods_id)) {
        echo '加入回收站成功';
    } else {
        echo '加入回收站失败';
    }
}