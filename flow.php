<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/25
 * Time: 11:35
 */

define('ACC', true);
require('./include/init.php');

//设置动作参数
$act = isset($_GET['act']) ? $_GET['act'] : 'buy';

//获取购物车实例
$cart = CartTool::getCart();
$goods = new GoodsModel();

if($act == 'buy') { //把商品加到购物车
    $goods_id = isset($_GET['goods_id']) ? $_GET['goods_id']+0 : 0;
    $num = isset($_GET['num']) ? $_GET['num']+0 : 1;

    if($goods_id) { //$goods_id为真，是想把商品放到购物车里
        $g = $goods->find($goods_id);

        if(!empty($g)) {
            //需要判断此商品，是否在回收站
            //此商品是否下架
            if($g['is_delete'] == 1 || $g['is_on_sale'] == 0) {
                $msg = '此商品不能购买';
                include(ROOT . 'view/front/msg.html');
                exit;
            }

            //先把商品加入到购物车
            $cart->addItem($goods_id, $g['goods_name'], $g['shop_price'], $num);

            //判断商品库存够不够
            $items = $cart->all();

            if($items[$goods_id]['num'] > $g['goods_number']) {
                //撤销刚才添加的商品数量
                $cart->decNum($goods_id, $num);

                $msg = '此商品不能购买,库存不足';
                include(ROOT . 'view/front/msg.html');
                exit;
            }
        }
    }

    $items = $cart->all();

    if(empty($items)) {
        header('location: index.php');
        exit;
    }

    $items = $goods->getCartGoods($items);

    $total = $cart->getPrice();
    $market_total = 0.0;

    foreach($items as $v) {
        $market_total += $v['market_price'] * $v['num'];
    }

    $discount = $market_total - $total;

    $rate = round(100 * $discount / $market_total, 2);

    include(ROOT . 'view/front/jiesuan.html');
} else if($act == 'clear') {
    $cart->clear();
    $msg = '购物车已清空';
    include(ROOT . 'view/front/msg.html');
    exit;
} else if($act == 'tijiao') {
    $items = $cart->all();

    $items = $goods->getCartGoods($items);

    $total = $cart->getPrice();
    $market_total = 0.0;

    foreach($items as $v) {
        $market_total += $v['market_price'] * $v['num'];
    }

    $discount = $market_total - $total;

    $rate = round(100 * $discount / $market_total, 2);

    include(ROOT . 'view/front/tijiao.html');
} else if($act == 'done') {
    $items = $cart->all();
    if(empty($items)) {
        header('location: index.php');
        exit;
    }

    //订单入库
    $order = new OrderModel();
    if(!$order->_validate($_POST)) {
        $msg = implode(',', $order->getErr());
        include(ROOT . 'view/front/msg.html');
        exit;
    }

    //自动过滤
    $data = $order->_facade($_POST);

    //自动填充
    $data = $order->_autoFill($data);

    //写入总金额
    $total = $data['order_amount'] = $cart->getPrice();

    //写入用户名，从session读
    $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
    $data['username'] = isset($_SESSION['username']) ? $_SESSION['username'] : '匿名';

    //写入订单号
    $order_sn = $data['order_sn'] = $order->orderSn();

    if(!$order->add($data)) {
        $msg = '下订单失败';
        include(ROOT . 'view/front/msg.html');
        exit;
    }

    //获取最新产生的order_id值
    $order_id = $order->insert_id();

    //把订单商品写入数据库
    $cnt = 0;

    $orderGoods = new OgModel();

    foreach($items as $key=>$v) {
        $data = array();

        $data['order_id'] = $order_id;
        $data['order_sn'] = $order_sn;
        $data['goods_id'] = $key;
        $data['goods_name'] = $v['name'];
        $data['goods_number'] = $v['num'];
        $data['shop_price'] = $v['price'];
        $data['subtotal'] = $v['price'] * $v['num'];

        $data = $orderGoods->_autoFill($data);

        if($orderGoods->addOrderGoods($data)) {
            $cnt += 1;  //插入成功一条商品，$cnt+1
        }
    }

    if(count($items) !== $cnt) {    //购物车中的商品并没有全部入库成功
        //撤销此订单
        $order->invoke($order_id);
        $msg = '下订单失败111';
        include(ROOT . 'view/front/msg.html');
        exit;
    }

    //下订单成功
    //清空购物车
    $cart->clear();

    //生成在线支付md5值
    $v_url = 'http://localhost/bool/recive.php';
    $md5key = 'sfsadf!@#123456';
    $v_md5info = md5($total . 'CNY' . $order_sn . '20272562' . $v_url . $md5key);
    $v_md5info = strtoupper($v_md5info);

    include(ROOT . 'view/front/order.html');
}