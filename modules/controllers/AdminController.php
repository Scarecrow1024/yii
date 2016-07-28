<?php

namespace app\modules\controllers;

use yii;
use yii\web\Controller;
use app\models\Privilege;
use app\models\Role;
use app\models\Admin;
use yii\db\Query;

/**
 * Default controller for the `admin` module
 */
class AdminController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layouts='register';

    public function actionIndex()
    {
        $model=new Admin();
        $data=$model->getRoleName();
        //die;
        //$data=$model->find()->asArray()->all();
    	$csrfToken=YII::$app->request->csrfToken;
		return $this->render('index',['data'=>$data]);
    }

    public function actionAdd(){
        if(YII::$app->request->isPost){
            //$max_id=Yii::$app->db->createCommand('select max(id) from admin')
            //->queryOne();
            //print_r(Yii::$app->request->post());
            $admin=new Admin();
            $admin->username=Yii::$app->request->post('username');
            $admin->password=Yii::$app->request->post('password');
            if($admin->insert()){
                echo "添加成功";
            }else{
                print_r($admin->getErrors());
            }
        }else{
            $model=new Role();
            $data=$model->find()->asArray()->all();
            return $this->render('add',['roleData'=>$data]);
        }      
    }

    public function actionEdit(){

    }

    public function actionDel(){
        $model=new Privilege();
        /*$data = (new Query())
        ->select('id')
        ->from('privilege')
        ->all();
        print_r($data);
        die;*/
        $data=$model->find()->asArray()->all();
        print_r($model->getChild($data,2));
    }
}
