<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/17
 * Time: 9:12
 */
defined('ACC') || exit('ACC Denied');

Class UpTool
{
    protected $allowExt = 'jpg,jpeg,gif,png,png';
    protected $maxSize = 1; //1M,M为单位
    protected $errno = 0;   // 错误代码
    protected $error = array(
        0  => '无错',
        1  => '上传的文件超出系统限制',
        2  => '上传文件大小超出网页表单页面',
        3  => '文件只有部分被上传',
        4  => '没有文件被上传',
        6  => '找不到临时文件夹',
        7  => '文件写入失败',
        8  => '不允许的文件后缀',
        9  => '文件大小超过类的允许范围',
        10  => '创建目录失败',
        11 => '移动失败'
    );

    /**
     * 上传图片
     * @param $key
     * @return bool|mixed
     */
    public function up($key) {
        if(!isset($_FILES[$key])) {
            return false;
        }

        $f = $_FILES[$key];

        //检查上传有没有成功
        if($f['error']) {
            $this->errno = $f['error'];
            return false;
        }

        //获取后缀
        $ext = $this->getExt($f['name']);

        //检查后缀
        if(!$this->isAllowExt($ext)) {
            $this->errno = 8;
            return false;
        }

        //检查大小
        if(!$this->isAllowSize($f['size'])) {
            $this->errno = 9;
            return false;
        }

        //通过
        //创建目录
        $dir = $this->mk_dir();

        if($dir == false) {
            $this->errno = 10;
            return false;
        }

        //生成随机文件名
        $newname = $this->randName() . '.' . $ext;
        $dir = $dir .'/'. $newname;

        //移动
        if(!move_uploaded_file($f['tmp_name'], $dir)) {
            $this->errno = 11;
            return false;
        }

        return str_replace(ROOT, '', $dir);
    }

    /**
     * 获取错误信息
     * @return mixed
     */
    public function getErr() {
        return $this->error[$this->errno];
    }

    /**
     * 允许的后缀
     * @param $exts
     */
    public function setExt($exts) {
        $this->allowExt = $exts;
    }

    /**
     * 允许的文件大小
     * @param $num
     */
    public function setSize($num) {
        $this->maxSize = $num;
    }

    /**
     * 获取文件后缀
     * @param $file
     * @return mixed
     */
    protected function getExt($file) {
        $tmp = explode('.',$file);
        return end($tmp);
    }

    /**
     * 检查文件后缀
     * @param $ext
     * @return bool
     */
    protected function isAllowExt($ext) {
        return in_array(strtolower($ext), explode(',', strtolower($this->allowExt)));
    }

    /**
     * 检查文件大小
     * @param $size
     * @return bool
     */
    protected function isAllowSize($size) {
        return $size <= $this->maxSize * 1024 * 1024;
    }

    /**
     * 按日期创建目录的方法
     * @return bool|string
     */
    protected function mk_dir() {
        $dir = ROOT . 'data/images/' . date('Ymd');

        //短路运算
        if(is_dir($dir) || mkdir($dir, 077, true)) {
           return $dir;
        } else {
            return false;
        }
    }

    /**
     * 生成随机文件名
     * @param int $length
     * @return string
     */
    protected function randName($length = 6) {
        $str = 'abcdefghijklmnopqrstuvwxyz23456789';
        return substr(str_shuffle($str), 0, $length);
    }
}