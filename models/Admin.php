<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;
use yii\db\Query;
use yii;

class Admin extends ActiveRecord{
    public function afterSave($insert, $changedAttributes){
        $role_ids=Yii::$app->request->post('role_id');
        $max_id=Yii::$app->db->createCommand('select max(id) from admin')
             ->queryOne();
        $max_id=$max_id['max(id)'];
        //添加用户后与角色表进行关联
        foreach($role_ids as $v){
            $sql="insert into admin_role (admin_id,role_id) values ($max_id,$v)";
            Yii::$app->db->createCommand($sql)
             ->execute();
        }

        var_dump($changedAttributes);
        var_dump($insert);
        echo "admin_role更新成功";
    }

    public function getRoleName(){
        $sql="select a.username,b.role_id,c.role_name from admin as a left join admin_role as b on a.id = b.admin_id left join role as c on c.id = b.role_id";
        $data=Yii::$app->db->createCommand($sql)
             ->queryAll();
        return $data;
    }
}