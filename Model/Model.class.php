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
    protected $table = null;    //是model所控制的表
    protected $db = null;       //是引入的mysql对象

    protected $pk = '';
    protected $_auto = array();
    protected $_valid = array();
    protected $error = array();


    public function __construct() {
        $this->db = mysql::getIns();
    }

    public function table($table) {
        $this->table = $table;
    }

    /**
     * 获得表结构
     */
    public function _filed() {
        $sql = "select * from " . $this->table;
        return $this->db->getFileds($sql);
    }

    /**
     * 自动过滤参数
     */
    public function _facade($array = array()) {
        $data = array();

        foreach($array   as $k=>$v) {
            if(in_array($k, $this->_filed())) {
                $data[$k] = $v;
            }
        }

        return $data;
    }

    /**
     * 自动填充参数
     */
    public function _autoFill($data) {
        foreach($this->_auto as $k=>$v) {
            if(!array_key_exists($v[0], $data)) {
                switch($v[1]) {
                    case 'value':
                        $data[$v[0]] = $v[2];
                        break;
                    case 'function':
                        $data[$v[0]] = call_user_func($v[2]);
                        break;
                }
            }
        }

        return $data;
    }

    /**
     * 自动验证参数
     */
    public function _validate($data) {
        if(empty($this->_valid)) {
            return true;
        }

        $this->error = array();

        foreach($this->_valid as $k=>$v) {
            switch($v[1]) {
                case 1:
                    if(!isset($data[$v[0]])) {
                        $this->error[] = $v[2];
                        return false;
                    }

                    if(!isset($v[4])) {
                        $v[4] = '';
                    }

                    if(!$this->check($data[$v[0]], $v[3], $v[4])) {
                        $this->error[] = $v[2];
                        return false;
                    }

                    break;
                case 0:
                    if(isset($data[$v[0]])) {
                        if(!$this->check($data[$v[0]], $v[3], $v[4])) {
                            $this->error[] = $v[2];
                            return false;
                        }
                    }

                    break;
                case 2:
                    if(isset($data[$v[0]]) && !empty($data[$v[0]])) {
                        if(!$this->check($data[$v[0]], $v[3], $v[4])) {
                            $this->error[] = $v[2];
                            return false;
                        }
                    }
            }
        }

        return true;
    }

    /**
     * 验证规则
     * @param $value
     * @param string $rule
     * @param string $parm
     * @return bool
     */
    protected function check($value, $rule='', $parm='') {
        switch($rule) {
            case 'require':
                return !empty($value);
            case 'number':
                return is_numeric($value);
            case 'in':
                $tmp = explode(',', $parm);
                return in_array($value, $tmp);
            case 'between':
                list($min, $max) = explode(',' ,$parm);
                return $value >= $min && $value <= $max;
            case 'length':
                list($min, $max) = explode(',' ,$parm);
                return strlen($value) >= $min && strlen($value) <= $max;
            case 'email':
                return (filter_var($value, FILTER_VALIDATE_EMAIL) !== false);
            default:
                return false;
        }
    }

    /**
     * @return array
     */
    public function getErr() {
        return $this->error;
    }

    /**
     * 添加add
     * @param $data
     * @return array|mixed|resource
     */
    public function add($data) {
        return $this->db->autoExecute($this->table,$data);
    }

    /**
     * 删除
     * @param $id
     * @return bool|int
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
     * @return int
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
     * 查询
     * @return array
     */
    public function select() {
        $sql = "select * from " . $this->table;
        return $this->db->getAll($sql);
    }

    /**
     * 查询单个
     * @param $id
     * @return array
     */
    public function find($id) {
        $sql = "select * from " . $this->table . ' where ' . $this->pk . "=" . $id;
        return $this->db->getRow($sql);
    }

    /**
     * 获取最新插入的id
     * @return int
     */
    public function insert_id() {
        return $this->db->insert_id();
    }
}