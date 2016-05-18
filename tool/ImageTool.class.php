<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/18
 * Time: 10:44
 */
defined('ACC') || exit('ACC Denied');

class ImageTool
{
    /**
     * 分析图片信息
     * @param $image
     * @return bool
     */
    public static function imageInfo($image) {
        //判断图片是否存在
        if(!file_exists($image)) {
            return false;
        }

        $info = getimagesize($image);

        if($info == false) {
            return false;
        }

        //此时info分析出来，是一个数组
        $img['width'] = $info[0];
        $img['height'] = $info[1];
        $img['ext'] = substr($info['mime'], strpos($info['mime'], '/')+1);

        return $img;
    }

    /**
     * 生成水印图片
     * @param $dst
     * @param $water
     * @param null $save
     * @param int $pos
     * @param int $alpha
     * @return bool
     */
    public static function water($dst, $water, $save=NULL, $pos=2, $alpha=50) {
        //判断图片是否存在
        if(!file_exists($dst) || !file_exists($water)) {
            return false;
        }

        //水印图片不能大于待操作图片
        $dinfo = self::imageInfo($dst);
        $winfo = self::imageInfo($water);

        if($winfo['height'] > $dinfo['height'] || $winfo['width'] > $dinfo['width']) {
            return false;
        }

        //将两张读到画布上
        $dfunc = 'imagecreatefrom' . $dinfo['ext'];
        $wfunc = 'imagecreatefrom' . $winfo['ext'];

        if(!function_exists($dfunc) || !function_exists($wfunc)) {
            return false;
        }

        //动态加载函数来创建画布
        $dim = $dfunc($dst);
        $wim = $wfunc($water);

        //根据水印的位置 计算粘贴的坐标
        switch($pos) {
            case 0: //左上角
                $dst_x=0;
                $dst_y=0;
                break;
            case 1: //右上角
                $dst_x = $dinfo['width'] - $winfo['width'];
                $dst_y = 0;
                break;
            case 3: //左下角
                $dst_x = 0;
                $dst_y = $dinfo['height'] - $winfo['height'];
                break;
            default:
                $dst_x = $dinfo['width'] - $winfo['width'];
                $dst_y = $dinfo['height'] - $winfo['height'];
        }

        //加水印
        imagecopymerge($dim, $wim, $dst_x, $dst_y, 0, 0, $winfo['width'], $winfo['height'], $alpha);

        //保存
        if(!$save) {
            $save = $dst;
            unlink($dst);   //删除原图
        }

        $createfunc = 'image' . $dinfo['ext'];
        $createfunc($dim, $save);

        imagedestroy($dim);
        imagedestroy($wim);

        return true;
    }

    /**
     * 生成缩略图 等比例缩放
     * @param $dst
     * @param null $save
     * @param int $width
     * @param int $height
     * @return bool
     */
    public static function thumb($dst, $save=NULL, $width=200, $height=200) {
        //判断图片是否存在
        if(!file_exists($dst)) {
            return false;
        }

        $dinfo = self::imageInfo($dst);
        //计算缩放比例
        $calc = min($width/$dinfo['width'], $height/$dinfo['height']);

        //创建原始图画布
        $dfunc = 'imagecreatefrom' . $dinfo['ext'];
        $dim = $dfunc($dst);

        //创建缩略画布
        $tim = imagecreatetruecolor($width, $height);

        //创建白色填充
        $white = imagecolorallocate($tim, 255, 255, 255);

        //填充缩略画布
        imagefill($tim, 0, 0, $white);

        //复制并缩略
        $dwidth = (int)$dinfo['width'] * $calc;
        $dheight = (int)$dinfo['height'] * $calc;

        $paddingx = (int)($width - $dwidth) / 2;
        $paddingy = (int)($height - $dheight) / 2;

        imagecopyresampled($tim, $dim, $paddingx, $paddingy, 0, 0, $dwidth, $dheight, $dinfo['width'], $dinfo['height']);

        //保存图片
        if(!$save) {
            $save = $dst;
            unlink($dst);
        }

        $createfunc = 'image' . $dinfo['ext'];
        $createfunc($tim, $save);

        imagedestroy($dim);
        imagedestroy($tim);

        return true;
    }

    //生成普通验证码
    public static function createCode() {
        //字符串
        $str = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ23456789";
        $code = substr(str_shuffle($str), 0, 5);

        //生成两块画布
        $src = imagecreatetruecolor(60,25);
        $dst = imagecreatetruecolor(60,25);

        //背景颜色
        $sgray = imagecolorallocate($src, 200, 200, 200);
        $dgray = imagecolorallocate($dst, 200, 200, 200);

        //字体颜色
        $sblue = imagecolorallocate($src, 0, 0, 255);

        imagefill($src, 0, 0, $sgray);
        imagefill($dst, 0, 0, $dgray);

        //写字
        imagestring($src, 5, 5, 4, $code, $sblue);

        header('Content-type: image/jpeg');
        imagejpeg($src);

    }
}