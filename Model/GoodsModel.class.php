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
}