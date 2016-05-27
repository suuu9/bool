<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/26
 * Time: 11:25
 */

class PageTool
{
    protected $total = 0;
    protected $perpage = 10;
    protected $page = 1;

    public function __construct($total, $perpage=false, $page=false) {
        $this->total = $total;
        if($perpage) {
            $this->perpage = $perpage;
        }

        if($page) {
            $this->page = $page;
        }
    }

    //主要函数，创建分页导航
    public function show() {
        $cnt = ceil($this->total / $this->perpage); //总页数
        $uri = $_SERVER['REQUEST_URI'];

        $parse = parse_url($uri);

        $param = array();
        if(isset($parse['query'])) {
            parse_str($parse['query'], $param);
        }

        unset($param['page']);

        $url = $parse['path'] . '?';
        if(!empty($param)) {
            $param = http_build_query($param);
            $url  = $url . $param . '&';
        }

        //计算页码导航
        $nav = array();
        $up = '';
        $down = '';
        $nav[0] = '<span class="page_now">' . $this->page . '</span>';

        for($left = $this->page-1,$right = $this->page+1;($left>=1||$right<=$cnt) && count($nav) < 5;) {

            if($left >= 1) {

                array_unshift($nav, '<a href="' . $url . 'page=' . $left .'">[' . $left . ']</a>');
                $left -= 1;
            }

            if($right <= $cnt) {

                array_push($nav, '<a href="' . $url . 'page=' . $right .'">[' . $right . ']</a>');
                $right += 1;
            }
        }

        if($this->page > 1) {
            $upnum = $this->page-1;
            $up = '<a href="' . $url . 'page=' . $upnum . '">上一页</a>';
        }

        if($this->page < $cnt) {
            $downnum = $this->page+1;
            $down = '<a href="' . $url . 'page=' . $downnum . '">下一页</a>';
        }

        return $up . implode('',$nav) . $down;

    }
}