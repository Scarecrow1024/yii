<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;
use yii\web\UploadedFile;

class Posts extends ActiveRecord{
    public $image;

    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}