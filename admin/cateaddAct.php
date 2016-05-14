<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/12
 * Time: 12:04
 */

/**
 * 添加分类
 * cateaddAct.php 接受表单数据，并插入表中
 *
 * 接收数据 $_POST
 *
 * 检验数据
 *
 * 实例化model 调用相应的model方法
 */
define('ACC', true);
require('../include/init.php');


$data = array();
if(empty($_POST['cat_name'])) {
    exit('栏目名不能为空');
}
$data['cat_name'] = $_POST['cat_name'];

$data['parent_id'] = $_POST['parent_id'];
$data['intro'] = $_POST['intro'];


$cat = new CatModel();

if($cat->add($data)) {
    echo '栏目添加成功';
    exit;
} else {
    echo '栏目添加失败';
    exit;
}