<?php
/**
 * 数据库抽象类 db.class.php
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 上午11:12
 */

abstract class db {

    /**
     * @param $h    服务器地址
     * @param $u    用户名
     * @param $p    密码
     * @return bool
     */

    public abstract function connect($h,$u,$p);

    /**
     * @param $sql  发送的sql语句
     * @return mixed    混合类型
     */
    public abstract function query($sql);

    /**
     * 查询多行数据
     * @param $sql
     * @param mixed
     */
    public abstract function getAll($sql);

    /**
     * 查询单行数据
     * @param $sql
     * @param mixed
     */
    public abstract function getRow($sql);

    /**
     * 查询单个数据
     * @param $sql
     * @param mixed
     */
    public abstract function getOne($sql);

    /**
     * 自动执行insert/update语句
     * @param $sql select语句
     * @return array/bool
     *
     * $this->autoExecute('user',array('username'=>'zhangsan','email'=>'zhang@163.com','insert'));
     * 将发生自动形成 insert into user (username,email) values ('zhangsan','zhang@163.com');
     */
    public abstract function autoExecute($table,$data,$act='insert',$where='');

}