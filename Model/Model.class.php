<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/9
 * Time: 18:00
 */

class Model
{
    protected $table = null;    //model���Ƶı���
    protected $db = null;       //����mysql����

    public function __construct() {
        $this->db = mysql::getIns();
    }

    public function table($table) {
        $this->table = $table;
    }
}