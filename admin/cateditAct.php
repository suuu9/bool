<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/12
 * Time: 16:10
 */

/**
 * 更新栏目
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

$cat_id = $_POST['cat_id'] + 0;

$cat = new CatModel();

$trees = $cat->getTree($data['parent_id']);

$flat = true;
foreach($trees as $v) {
    if($v['cat_id'] == $cat_id) {
        $flag = false;
        break;
    }
}

if(!$flag) {
    echo $cat_id . '是' . $data['parent_id'] .'的祖先';
    exit;
}


if($cat->update($data, $cat_id)) {
    echo '栏目更新成功';
} else {
    echo '栏目更新失败';
}