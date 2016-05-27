<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/24
 * Time: 23:52
 */

define('ACC', true);
require('./include/init.php');

$goods_id = isset($_GET['goods_id'])?$_GET['goods_id']+0:0;

//先查询这个商品信息
$goods = new GoodsModel();
$g = $goods->find($goods_id);

if(empty($g)) {
    header('location: index.php');
    exit;
}

//取出面包屑导航
$cat = new CatModel();
$nav = $cat->getTree($g['cat_id']);

include(ROOT . 'view/front/shangpin.html');