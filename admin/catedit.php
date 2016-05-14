<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/12
 * Time: 15:44
 */

/**
 * 编辑栏目
 */
define('ACC', true);
require('../include/init.php');

$cat_id = $_GET['cat_id'] + 0;

$cat = new CatModel();

$catinfo = $cat->find($cat_id);

$catlist = $cat->select();
$catlist = $cat->getCatTree($catlist, 0);

include(ROOT . 'view/admin/admin-catedit.php');