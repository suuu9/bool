<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/12
 * Time: 15:04
 */

/**
 * 删除分类
 */
define('ACC', true);
require('../include/init.php');

$cat_id = $_GET['cat_id'] + 0;

$cat = new CatModel();

$sons = $cat->getSon($cat_id);
if(!empty($sons)) {
    exit('有子栏目，不允许删除!');
}

if($cat->delete($cat_id)) {
    echo '删除成功';
} else {
    echo '删除失败';
}