<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;

class Privilege extends ActiveRecord{

    /*
    获取子分类
    */
    public function getChild($array=array(),$id=0,$lev=0){
        static $data=array();
        foreach($array as $v){
            if($v['parent_id']==$id){
                $v['lev']=$lev;
                $data[]=$v;
                $this->getChild($array,$v['id'],$lev+1);
            }
        }
        return $data;
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