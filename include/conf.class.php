<?php
/**
 * file conf.class.php
 * 配置文件读取类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 下午1:12
 */

class conf {

    protected static $ins = null;
    protected $data = array();

    final protected function __construct() {
        include (ROOT . 'include/config.inc.php');
        $this->data = $_CFG;
    }

    //防止被克隆
    final protected function __clone() {

    }

    public static function getIns() {
        if(self::$ins instanceof self) {
            return self::$ins;
        } else {
            self::$ins = new self();
            return self::$ins;
        }
    }

    //用魔术方法，读取data内的信息
    public function __get($key) {
        if(array_key_exists($key,$this->data)) {
            return $this->data[$key];
        } else {
            return null;
        }
    }

    //用魔术方法，在运行期，动态增加或改变配置选项
    public function __set($key,$value) {
        $this->data[$key] = $value;
    }
}