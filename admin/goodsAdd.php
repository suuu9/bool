<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/13
 * Time: 11:13
 */

/**
 * 添加新商品
 */
define('ACC', true);
require('../include/init.php');

$cat = new CatModel();
$catlist = $cat->select();
$catlist = $cat->getCatTree($catlist);

include(ROOT . 'view/admin/admin_goods_add.php');