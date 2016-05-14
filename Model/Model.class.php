<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/9
 * Time: 18:00
 */
defined('ACC') || exit('ACC Denied');

class Model
{
    protected $table = null;    //model控制的表明
    protected $db = null;       //引入mysql对象
    protected $pk = '';

    public function __construct() {
        $this->db = mysql::getIns();
    }

    public function table($table) {
        $this->table = $table;
    }

    /**
     * 添加add
     * @param array
     * @return bool
     */
    public function add($data) {
        return $this->db->autoExecute($this->table,$data);
    }

    /**
     * 删除
     * @param $id
     * @return 影响的函数
     */

    public function delete($id) {
        $sql = "delete from " . $this->table . " where " . $this->pk . '=' .$id;
        if($this->db->query($sql)) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    /**
     * 更新
     * @param array
     * @param id
     * @return int 影响行数
     */
    public function update($data, $id) {
        $result = $this->db->autoExecute($this->table, $data, 'update', ' where ' . $this->pk . '=' . $id);
        if($result) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    /**
     * 查询列表
     * @return array
     */
    public function select() {
        $sql = "select * from " . $this->table;
        return $this->db->getAll($sql);
    }

    /**
     * 获取单行
     * @param $id
     * @return array
     */
    public function find($id) {
        $sql = "select * from " . $this->table . ' where ' . $this->pk . "=" . $id;
        return $this->db->getRow($sql);
    }
}