<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "giitest".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 */
class Giitest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $test1;
    public $test2;
    public $test3;
    public $verifyCode;
    public static function tableName()
    {
        return 'giitest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['test1', 'required'],
            [['name'], 'string', 'max' => 10],
            [['email','email'], 'string', 'max' => 30],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
        ];
    }

    /**
     * @inheritdoc
     * @return GiitestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GiitestQuery(get_called_class());
    }
}
