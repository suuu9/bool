<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/13
 * Time: 11:51
 */

define('ACC', true);
require('../include/init.php');

$goods = new GoodsModel();
$_POST['goods_weight'] *= $_POST['weight_unit'];

$data = array();
$data = $goods->_facade($_POST);
$data = $goods->_autoFill($data);

//添加自动商品货号
if(empty($data['goods_sn'])) {
    $data['goods_sn'] = $goods->createSn();
}

if(!$goods->_validate($data)) {
    echo '数据不合法<br />';
    echo implode(',', $goods->getErr());
    return false;
}

$uptool = new UpTool();
$ori_img = $uptool->up('ori_img');

if($ori_img) {
    $data['ori_img'] = $ori_img;
}

//生成中等大小缩略图 300*400
$ori_img = ROOT . $ori_img;

$goods_img = dirname($ori_img) . '/goods_' . basename($ori_img);
if(ImageTool::thumb($ori_img, $goods_img, 300, 400)) {
    $data['goods_img'] = str_replace(ROOT, '', $goods_img);
}

//生成小缩略图 160*200
$thumb_img = dirname($ori_img) . '/thumb_' . basename($ori_img);
if(ImageTool::thumb($ori_img, $thumb_img, 160, 200)) {
    $data['thumb_img'] = str_replace(ROOT, '', $thumb_img);
}



if($goods->add($data)) {
    echo '商品发布成功';
} else {
    echo '商品发布失败';
}

