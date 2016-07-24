<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 * @property integer $create_time
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'author', 'email', 'url', 'post_id', 'create_time'], 'required'],
            [['content'], 'string'],
            [['status', 'post_id', 'create_time'], 'integer'],
            [['author', 'url'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'status' => 'Status',
            'author' => 'Author',
            'email' => 'Email',
            'url' => 'Url',
            'post_id' => 'Post ID',
            'create_time' => 'Create Time',
        ];
    }
}
