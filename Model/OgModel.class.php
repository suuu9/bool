<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/25
 * Time: 16:51
 */

defined('ACC') || exit('ACC Denied');

class OgModel extends Model
{
    protected $table = 'ordergoods';
    protected $pk = 'og_id';

    protected $_auto = array(
        array('add_time', 'function', 'time'),
    );

    //把商品订单写入ordergoods表
    public function addOrderGoods($data) {
        if($this->add($data)) {
            //更新goods表 减少库存
            $sql = "update goods set goods_number = goods_number - " . $data['goods_number'] . " where goods_id = " . $data['goods_id'];

            log::write($sql);

            return $this->db->query($sql);
        }

        return false;
    }
}