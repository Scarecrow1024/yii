<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\UploadedFile;

class Info extends ActiveRecord{
    public $verifyCode;
    public $file;
    public $imageFile;
    public $username;
    //public $verifyCode;
    public function rules(){
    	return [
    		['id','integer'],
            //['file', 'file'],
    		['name','string','length'=>[5,10]],
            //[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            //['verifyCode', 'required'],
           // ['verifyCode', 'captcha'],
    		//['verifyCode', 'captcha','captchaAction'=>'hello/captcha'],
    	];
    }

    public function afterSave($insert, $changedAttributes){
        var_dump($changedAttributes);
        echo "after save";
    }

    public function afterFind(){
        echo "find after<br>";
    }

    public function getOrders(){
    	return $this->hasMany(Order::className(),['uid'=>'id'])->asArray();
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}