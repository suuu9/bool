<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/13
 * Time: 20:05
 */

/**
 * 删除商品
 */
define('ACC', true);
require('../include/init.php');

$goods_id = $_GET['goods_id'] + 0;

$goods = new GoodsModel();

if($goods->delete($goods_id)) {
    echo '商品删除成功';
} else {
    echo '商品删除失败';
}
