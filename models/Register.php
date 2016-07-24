<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;
use app\models\Login;

class Register extends ActiveRecord
{
	public $repassword;


	/*public static function tableName()
    {
        return 'bl_user';
    }*/

	public function rules()
	{
    	return [
    		 [['username', 'email'], 'required' ,'message'=>'必填'],
    		 ['username', 'string', 'length' => [3, 10], 'message'=>'长度为3-10'],
    		 //['username','checkname'],
    		 ['email', 'email' ,'message'=>'请填写正确的字段'],
    		 ['password', 'required','message' => '密码不能为空'],
        	 ['password', 'string', 'min' => 6],
        	 ['repassword', 'compare', 'compareAttribute'=>'password', 'message'=>'必须与密码相同']
    	];
    }
 

	 public function findByAttributes($arr=array()){
	 	return Login::model()->find()->where($arr)->one();
	 }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'email' => '邮箱',
            'password' => '密码',
            'repassword' => '重复密码'
        ];
    }
}