<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;

class Role extends ActiveRecord{
    public $pri_id=array();
    // 找一个分类所有子分类的ID
    public function getChildren($catId){
        // 取出所有的分类
        $data = $this->find()->asArray()->all();
        // 递归从所有的分类中挑出子分类的ID
        return $this->_getChildren($data, $catId, TRUE);
    }
    /**
     * 递归从数据中找子分类
     */
    private function _getChildren($data, $catId, $isClear = FALSE){
        static $_ret = array();  // 保存找到的子分类的ID
        if($isClear)
            $_ret = array();
        // 循环所有的分类找子分类
        foreach ($data as $k => $v)
        {
            if($v['parent_id'] == $catId)
            {
                $_ret[] = $v['id'];
                // 再找这个$v的子分类
                $this->_getChildren($data, $v['id']);
            }
        }
        return $_ret;
    }


    public function _tree($array=array(),$pid=0,$lev=0){
        static $data=array();
        foreach($array as $v){
            if($v['parent_id']==$pid){
                $v['lev']=$lev;
                $data[]=$v;
                $this->_tree($array,$v['id'],$lev+1);
            }
        }
        return $data;
    }
}