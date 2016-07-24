<?php
namespace app\widgets\hello;

use yii\base\Widget;
class HelloWidget extends Widget
{
    public $msg = '';
    /**
     * 初始化
     * @see \yii\base\Object::init()
     */
    public function init(){
        parent::init();      
    }
    
    
    public function run(){
        return $this->render('index',['msg'=>$this->msg]);
    }
}