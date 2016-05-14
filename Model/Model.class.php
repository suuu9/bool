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
    protected $table = null;    //model���Ƶı���
    protected $db = null;       //����mysql����
    protected $pk = '';

    public function __construct() {
        $this->db = mysql::getIns();
    }

    public function table($table) {
        $this->table = $table;
    }

    /**
     * ���add
     * @param array
     * @return bool
     */
    public function add($data) {
        return $this->db->autoExecute($this->table,$data);
    }

    /**
     * ɾ��
     * @param $id
     * @return Ӱ��ĺ���
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
     * ����
     * @param array
     * @param id
     * @return int Ӱ������
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
     * ��ѯ�б�
     * @return array
     */
    public function select() {
        $sql = "select * from " . $this->table;
        return $this->db->getAll($sql);
    }

    /**
     * ��ȡ����
     * @param $id
     * @return array
     */
    public function find($id) {
        $sql = "select * from " . $this->table . ' where ' . $this->pk . "=" . $id;
        return $this->db->getRow($sql);
    }
}