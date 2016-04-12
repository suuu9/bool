<?php
/**
 * file log.class.php
 * 日志类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-4-12
 * Time: 下午1:51
 */

class log {
    const LOGFILE = 'curr.log';
    //写日志
    public static function write($cont) {
        $cont .= "\r\n";    //每写入一次换行一次
        //判断大小
        $log = self::isBak();

        $fh = fopen($log,'ab'); //追加写入

        fwrite($fh,$cont);

        fclose($fh);    //关闭句柄
    }

    //备份日志
    private static function bak() {
        $log = ROOT . 'data/log/' . self::LOGFILE;
        $bak = ROOT . 'data/log/' . date('ymd') . mt_rand(10000,99999) . '.bak';
        return rename($log,$bak);
    }

    //读取并判断日志大小
    private static function isBak() {
        $log = ROOT . 'data/log/' . SELF::LOGFILE;

        //判断文件是否存在，如果不存在则创建
        if(!file_exists($log)) {
            touch($log);
            return $log;
        }

        //清楚缓存
        clearstatcache(true,$log);

        //日志文件存在，判断日志文件大小 是否大于1M
        $size = filesize($log);

        if($size <= 1024*1024) {
            return $log;
        }

        //如果大于1M，则备份
        if(self::bak()) {
            return $log;
        } else {
            touch($log);
            return $log;
        }
    }
}