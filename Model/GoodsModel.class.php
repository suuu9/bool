<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/13
 * Time: 14:50
 */
defined('ACC') || exit('ACC Denied');

class GoodsModel extends Model
{
    protected $table = 'goods';
    protected $pk = 'goods_id';

    protected $_auto = array(
        array('is_hot', 'value', 0),
        array('is_new', 'value', 0),
        array('is_best', 'value', 0),
        array('add_time', 'function', 'time'),
    );

    protected $_valid = array(
        array('goods_name', 1, '必须有商品名', 'require'),
        array('cat_id', 1, '栏目id必须是整型值', 'number'),
        array('is_new', 0, 'is_new只能是0或1', 'in', '0,1'),
        array('goods_brief', 2, '商品简介只能在10到100字符', 'length', '10,100')
    );


    /**
     * 回收站
     * @param $id
     * @return int 印象行数
     */
    public function trash($id) {
        return $this->update(array('is_delete'=>1), $id);
    }

    /**
     * 获取商品列表（不包含回收站）
     * @return array
     */
    public function getGoods() {
        $sql = "select * from " . $this->table . " where is_delete=0";
        return $this->db->getAll($sql);
    }

    /**
     * 获取回收商品
     * @return array
     */
    public function getTrash() {
        $sql = "select * from " . $this->table . " where is_delete=1";
        return $this->db->getAll($sql);
    }

    public function createSn() {
        $sn = 'BL' . date('Ymd') . rand(10000,99999);

        $sql = "select count(*) from " . $this->table . " where goods_sn = '" . $sn . "'";

        return $this->db->getOne($sql) ? $this->createSn() : $sn;
    }
}