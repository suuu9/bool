<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/9
 * Time: 11:37
 */
defined('ACC') || exit('ACC Denied');

class mysql extends db
{
    private static $ins = null;
    private $conn = null;
    private $conf = array();


    protected function __construct()
    {
        $this->conf = conf::getIns();

        $this->connect($this->conf->host, $this->conf->user, $this->conf->pwd);
        $this->select_db($this->conf->db);
        $this->setChar($this->conf->char);
    }

    public function __destruct()
    {

    }

    public static function getIns()
    {
        if (!(self::$ins instanceof self)) {
            self::$ins = new self();
        }

        return self::$ins;
    }

    public function connect($h, $u, $p)
    {
        $this->conn = mysql_connect($h, $u, $p);
        if (!$this->conn) {
            $err = new Exception('Á¬½ÓÊ§°Ü');
            throw $err;
        }
        log::write('connect:' . $h .',' . $u .','. $p);
    }

    protected function select_db($db)
    {
        $sql = 'use ' . $db;
        $this->query($sql);
        log::write('use ' . $db);
    }

    protected function setChar($char)
    {
        $sql = 'set names ' . $char;
        log::write('set names ' . $char);
        return $this->query($sql);
    }

    public function query($sql)
    {
        if($this->conf->debug) {
            log::write($sql);
        }

        $rs = mysql_query($sql, $this->conn);

        if(!$rs) {
            log::write(mysql_error());
        }

        return $rs;
    }

    public function autoExecute($table, $arr, $mode='insert',$where = ' where 1 limit 1')
    {
        if(!is_array($arr)) {
            return false;
        }

        if($mode == 'update') {
            $sql = 'update ' . $table . ' set ';
            foreach($arr as $key=>$v) {
                $sql .= $key . "='" . $v . "',";
            }

            $sql = rtrim($sql,',');
            $sql .= $where;

            log::write('update:' . $sql);

            return $this->query($sql);
        }

        $sql = 'insert into ' . $table . ' (' . implode(',',array_keys($arr)) . ')';
        $sql .= ' values (\'';
        $sql .= implode("','",array_values($arr));
        $sql .= '\')';
        log::write('insert:' . $sql);

        return $this->query($sql);
    }

    public function getAll($sql)
    {
        $rs = $this->query($sql);

        $list = array();
        while($row = mysql_fetch_assoc($rs)) {
            $list[] = $row;
        }

        return $list;
    }

    public function getRow($sql)
    {
        $rs = $this->query($sql);

        return mysql_fetch_assoc($rs);
    }

    public function getOne($sql)
    {
        $rs = $this->query($sql);
        $row = mysql_fetch_row($rs);

        return $row[0];
    }

    public function affected_rows()
    {
        return mysql_affected_rows($this->conn);
    }

    public function insert_id() {
        return mysql_insert_id($this->conn);
    }
}