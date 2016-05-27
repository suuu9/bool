<?php
/**
 * Created by PhpStorm.
 * User: 56553
 * Date: 2016/5/12
 * Time: 11:59
 */
defined('ACC') || exit('ACC Denied');

class CatModel extends Model
{
    protected $table = 'category';

    /**
     * 添加add
     * @param array
     * @return bool
     */
    public function add($data) {
        return $this->db->autoExecute($this->table,$data);
    }

    /**
     * 获取分类数据
     */
    public function select() {
        $sql = "select cat_id,cat_name,intro,parent_id from " . $this->table;
        return $this->db->getAll($sql);
    }

    /**
     * 获取一条数据
     * @param int cat_id
     * @return arr
     */
    public function find($cat_id=0) {
        $sql = "select cat_id,cat_name,intro,parent_id from " . $this->table . ' where cat_id=' . $cat_id;
        return $this->db->getRow($sql);
    }

    /**
     * 获取分类子孙树结构
     * @param $arr
     * @param $id
     * @param $lev
     * @return #@tree
     */
    public function getCatTree($arr, $id=0, $lev=0) {
        $tree = array();

        foreach($arr as $v) {
            if($v['parent_id'] == $id) {
                $v['lev'] = $lev;
                $tree[] = $v;

                $tree = array_merge($tree, $this->getCatTree($arr, $v['cat_id'], $lev+1));
            }
        }

        return $tree;
    }

    /**
     * 获取子栏目
     * @param int $id
     * @return id栏目下的子栏目
     */
    public function getSon($id) {
        $sql = "select cat_id,cat_name,intro,parent_id from " . $this->table . " where parent_id=" . $id;
        return $this->db->getAll($sql);
    }

    /**
     * 获取某栏目下的家谱树
     * @param int id
     * @return array
     */
    public function getTree($id) {
        $tree = array();
        $cats = $this->select();

        while($id>0) {
            foreach($cats as $v) {
                if($v['cat_id'] == $id) {
                    $tree[] = $v;

                    $id = $v['parent_id'];
                    break;
                }
            }
        }

        return array_reverse($tree);
    }

    /**
     * 删除栏目
     * @param $cat_id
     * @return bool
     */
    public function delete($cat_id=0) {
        $sql = 'delete from ' . $this->table . ' where cat_id=' . $cat_id;
        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    /**
     * 更新栏目
     * @param $data
     * @param $cat_id
     * @return bool
     */
    public function update($data, $cat_id=0) {
        $this->db->autoExecute($this->table, $data, 'update', '     where cat_id=' . $cat_id);
        return $this->db->affected_rows();
    }
}