<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;

class Login extends ActiveRecord
{
    public $verifyCode;
    public $token;
    public $status;

	public static function tableName()
    {
        return 'register';
    }

	public function rules()
	{
    	return [
    		 ['username', 'required'],
    		 ['password', 'required','message' => '密码不能为空'],
             ['verifyCode', 'required'],
             ['verifyCode', 'captcha','captchaAction'=>'admin/login/captcha'],
    	];
    }
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }
}