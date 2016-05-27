<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 上午10:59
 * 程序入口文件
 */

define('ACC', true);
require('./include/init.php');

$goods = new GoodsModel();

$newlist = $goods->getNew(5);

//女栏目下的商品
$female = 4;
$felist = $goods->catGoods($female, 5);

include(ROOT . 'view/front/index.html');