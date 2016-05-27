<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/25
 * Time: 1:25
 */
defined('ACC') || exit('ACC Denied');

class CartTool
{
    private static $ins = null;
    private $items = array();

    final protected function __construct() {

    }

    final protected function __clone() {

    }

    //获取实例
    protected static function getIns() {
        if(!(self::$ins instanceof self)) {
            self::$ins = new self();
        }

        return self::$ins;
    }

    /**
     * 把购物车的单例对象放到session里
     * @return CartTool|null
     */
    public static function getCart() {
        if(!isset($_SESSION['cart']) || !($_SESSION['cart'] instanceof self)) {
            $_SESSION['cart'] = self::getIns();
        }

        return $_SESSION['cart'];
    }

    /**
     * 添加商品
     * @param $id
     * @param $name
     * @param $price
     * @param int $num
     */
    public function addItem($id, $name, $price, $num=1 ) {
        //如果该商品已经存在，则直接加其数量
        if($this->hasItem($id)) {
            $this->incNum($id, $num);
            return;
        }
        $item = array();
        $item['name'] = $name;
        $item['price'] = $price;
        $item['num'] = $num;

        $this->items[$id] = $item;
    }

    /**
     * 修改购物车中的商品数量
     * @param $id
     * @param int $num
     * @return bool
     */
    public function modNum($id, $num=1) {
        if(!$this->hasItem($id)) {
            return false;
        }

        $this->items[$id]['num'] = $num;
    }

    /**
     * 商品数量增加1
     * @param $id
     * @param int $num
     */
    public function incNum($id, $num=1) {
        if($this->hasItem($id)) {
            $this->items[$id]['num'] += 1;
        }
    }

    /**
     * 商品数量减少1
     * @param $id
     * @param int $num
     */
    public function decNum($id, $num=1) {
        if($this->hasItem($id)) {
            $this->items[$id]['num'] -= $num;
        }

        //如果减少后，数量为0了，则把这个商品从购物车删掉
        if($this->items[$id]['num'] < 1) {
            $this->delItem($id);
        }

    }

    /**
     * 判断某商品是否存在
     * @param $id
     * @return bool
     */
    public function hasItem($id) {
        return array_key_exists($id, $this->items);
    }

    /**
     * 删除商品
     * @param $id
     */
    public function delItem($id) {
        unset($this->items[$id]);
    }

    /**
     * 查询购物车中商品的种类
     * @return int
     */
    public function getCnt() {
        return count($this->items);
    }

    /**
     * 查询商品购物车中的个数
     * @return int
     */
    public function getNum() {
        if($this->getCnt() == 0) {
            return 0;
        }

        $sum = 0;

        foreach($this->items as $item) {
            $sum += $item['num'];
        }

        return $sum;
    }

    /**
     * 查询购物车中商品的总金额
     * @return float|int
     */
    public function getPrice() {
        if($this->getCnt() == 0) {
            return 0;
        }

        $price = 0.0;

        foreach($this->items as $item) {
            $price += $item['num'] * $item['price'];
        }

        return $price;
    }

    /**
     * 返回购物车中的所有商品
     * @return array
     */
    public function all() {
        return $this->items;
    }

    /**
     * 清空购物车
     */
    public function clear() {
        $this->items = array();
    }
}