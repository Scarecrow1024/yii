<?php

namespace app\modules\controllers;

use yii;
use yii\web\Controller;
use app\models\Role;
use app\models\Privilege;
use yii\db\Query;

/**
 * Default controller for the `admin` module
 */
class RoleController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layouts='register';

    public function actionIndex()
    {
        header('Content-Type:text/html;charset:utf-8');
        $role=new Role();
        $roles=$role->find()->asArray()->all();

        $privilege=new Privilege();
        $data=array();
        foreach($roles as $k=>$v){
            $data[][]=$roles[$k]['role_name'];
            $role_id=explode(',', $roles[$k]['role_id']);
            $pri_names=(new Query())->select('GROUP_CONCAT(distinct privilege.pri_name) pri_name')->join('RIGHT JOIN','role',['privilege.id'=>$role_id])->from('privilege')->all();
            $data[]=$pri_names;
        }
        //print_r($data);
        //die;
        //偶数和奇数分别合并
        $con=count($data)-1;
        for($i=0;$i<=$con;$i++){
            if($i%2==0){
                $data['role_name'][]=$data[$i][0];
            }
            if($i%2!=0){
                $data['pri_names'][]=$data[$i][0];
            }
        }
        //print_r($data);
        //die;
        $array=array();
        $array[]=$data['role_name'];
        $array[]=$data['pri_names'];
        //print_r($array);
        /*$array=array();
        for($i=0;$i<count($data)/2;$i++){
            $array[]=array_merge($data[$i],$data[$i+1]);
        }
        //交换位置使格式一致
        foreach($array as $k=>$v){
            if($k%2==0){
                $tmp=$array[$k][0];
                $array[$k][0]=$array[$k][1];
                $array[$k][1]=$tmp;
            }
        }*/
        //print_r($array);
        //echo $array[0][0]['pri_name'];
        // /die;
        //die;
        //print_r(array_merge($data[0],$data[1]));
        //print_r($data);
        //die;
        //$pri_names=$privilege->find()->where(['id'=>$role_id])->asArray()->all();
        //print_r($pri_names);
        return $this->render('index',['array'=>$array]);
    }

    public function actionAdd(){
        if(YII::$app->request->isPost){
            $role_id=implode(Yii::$app->request->post('pri_id'),',');
            $role_name=Yii::$app->request->post('role_name');
            $model=new Role();
            $model->role_name=$role_name;
            $model->role_id=$role_id;
            if($model->insert()){
                echo "添加成功";
            }else{
                print_r($model->getErrors());
            }
        }else{
            $model=new Privilege();
            $data=$model->find()->asArray()->all();
            $tree=$model->_tree($data);
            //print_r($tree);
            $csrfToken=YII::$app->request->csrfToken;
            return $this->render('add',['tree'=>$tree]);
        }     
    }

    public function actionEdit(){

    }

    public function actionDel(){
        
    }
}
