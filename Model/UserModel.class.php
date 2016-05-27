<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/19
 * Time: 9:50
 */
defined('ACC') || exit('ACC Denied');

class UserModel extends Model
{
    protected $table = 'user';
    protected $pk = 'user_id';

    protected $_valid = array(
        array('username', 1, '用户名必须存在', 'require'),
        array('username', 0, '用户名必须在4-16之间', 'length', '4,16'),
        array('email', 1, 'email非法', 'email'),
        array('passwd', 1, 'passwd不能为空', 'require')
    );

    protected $_auto = array(
        array('regtime', 'function', 'time')
    );

    /**
     * 用户注册
     * @param $data
     * @return array|mixed|resource
     */
    public function reg($data) {
        if($data['passwd']) {
            $data['passwd'] = $this->encPassword($data['passwd']);
        }

        return $this->add($data);
    }

    /**
     * 密码md5加密
     * @param $p
     * @return string
     */
    protected function encPassword($p) {
        return md5($p);
    }

    /**
     * 查询用户名是否存在
     * @param $username
     * @return mixed
     */
    public function checkUser($username, $passwd='') {
        if($passwd == '') {
            $sql = "select count(*) from " . $this->table . " where username='" . $username . "'";
            return $this->db->getOne($sql);
        } else {
            $sql = "select user_id, username, email, passwd from " . $this->table . " where username='" . $username . "'";

            $row = $this->db->getRow($sql);

            if(empty($row)) {
                return false;
            }

            if($row['passwd'] != $this->encPassword($passwd)) {
                log::write('密码不服' . $row['passwd']);
                return false;
            }

            unset($row['passwd']);
            return $row;
        }

    }
}