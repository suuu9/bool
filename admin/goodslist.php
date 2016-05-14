<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/13
 * Time: 17:00
 */

/**
 * 商品列表
 */
define('ACC', true);
require('../include/init.php');

$goods = new GoodsModel();
$goodslist = $goods->getGoods();

include(ROOT . 'view/admin/admin_goods_list.php');

