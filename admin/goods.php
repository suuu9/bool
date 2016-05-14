<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/13
 * Time: 17:30
 */

define('ACC', true);
require('../include/init.php');


$goods_id = $_GET['goods_id'] + 0;

$goods = new GoodsModel();

$goodsdesc = $goods->find($goods_id);

if(empty($goodsdesc)) {
    echo '商品不存在，请查看商品id';
} else {
    echo '<pre>';
    print_r($goodsdesc);
    echo '</pre>';
}