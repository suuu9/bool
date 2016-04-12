<?php
/**
 * file lib_base.php
 * 系统常用方法
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 下午2:34
 */


    /**
     * 递归转义数组
     */
    function _addslashes($arr) {
        foreach($arr as $key=>$v) {
            if(is_string($v)) {
                $arr[$key] = addslashes($v);
            } else if(is_array($v)) {
                $arr[$key] = _addslashes($v);
            }
        }
        return $arr;
    }