<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/25
 * Time: 15:15
 */

defined('ACC') || exit('ACC Denied');

class OrderModel extends Model
{
    protected $table = 'orderinfo';
    protected $pk = 'order_id';

    protected $_auto = array(
        array('add_time', 'function', 'time'),
    );

    protected $_valid = array(
        array('reciver', 1, '收货人不能为空', 'require'),
        array('email', 1, 'email非法', 'email'),
        array('pay', 1, '必须选择支付方式', 'in', '4,5'),   //代表在线支付与到付
    );

    /**
     * 订单号
     * @return string
     */
    public function orderSn() {
        $sn = 'OI' . date('Ymd') . mt_rand(10000, 99999);

        $sql = "select count(*) from " . $this->table . " where order_sn= '" . $sn . "'";
        return $this->db->getOne($sql) ? $this->orderSn() : $sn;
    }

    /**
     * 撤销订单
     * @param $order_id
     * @return mixed|resource
     */
    public function invoke($order_id) {
        //先删订单
        $this->delete($order_id);
        //再删订单对应的商品
        $sql = "delete from ordergoods where order_id = " . $order_id;

        return $this->db->query($sql);
    }
}