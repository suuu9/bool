<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/9
 * Time: 18:06
 */

class TestModel extends Model
{
    protected $table = 'test';
    public function reg($data) {
        return $this->db->autoExecute($this->table, $data, $mode='insert');
    }
}