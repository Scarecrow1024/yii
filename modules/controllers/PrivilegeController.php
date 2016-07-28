<?php

namespace app\modules\controllers;

use yii;
use yii\web\Controller;
use app\models\Privilege;
use yii\db\Query;

/**
 * Default controller for the `admin` module
 */
class PrivilegeController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layouts='register';

    public function behaviors(){
        return [
            [
                'class'=>'yii\filters\PageCache',
                'only'=>['index'],
                'duration'=>60,
                'dependency'=>[
                    'class'=>'yii\caching\DbDependency',
                    'sql'=>'select COUNT(*) from privilege',
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model=new Privilege();
        $data=$model->find()->asArray()->all();
        $tree=$model->_tree($data);
        //print_r($tree);
    	$csrfToken=YII::$app->request->csrfToken;
		return $this->render('index',['tree'=>$tree]);
    }

    public function actionAdd(){
        if(YII::$app->request->isPost){
            $model=new Privilege();
            $model->pri_name=Yii::$app->request->post('pri_name');
            $model->parent_id=Yii::$app->request->post('parent_id');
            $model->model=Yii::$app->request->post('model');
            $model->controller=Yii::$app->request->post('controller');
            $model->action=Yii::$app->request->post('action');
            if($model->insert()){
                echo "添加成功";
            }else{
                print_r($model->getErrors());
            }
        }else{
            $model=new Privilege();
            $data=$model->find()->asArray()->all();
            $tree=$model->_tree($data);
            return $this->render('add',['tree'=>$tree]);
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
