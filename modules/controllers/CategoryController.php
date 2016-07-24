<?php

namespace app\modules\controllers;

use yii;
use yii\web\Controller;
use app\models\Category;

/**
 * Default controller for the `admin` module
 */
class CategoryController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layouts='register';

    public function actionIndex()
    {
        $model=new Category();
        $data=$model->find()->asArray()->all();
        $tree=$model->_tree($data);
        //print_r($tree);
    	$csrfToken=YII::$app->request->csrfToken;
		return $this->render('index',['tree'=>$tree]);
    }

    public function actionAdd(){
        $model=new Category();
        if(YII::$app->request->isPost){
            $model=new Category();
            $parent_id=YII::$app->request->post('parent_id');
            $cat_name=YII::$app->request->post('Category')['cat_name'];
            $model->parent_id=$parent_id;
            $model->cat_name=$cat_name;
            if($model->save()){
                echo "添加成功";
                die;
            }
        }
        $data=$model->find()->asArray()->all();
        $tree=$model->_tree($data);
        //print_r($tree);
        $csrfToken=YII::$app->request->csrfToken;
        return $this->render('add',['tree'=>$tree]);
    }

    public function actionEdit(){
        $model=new Category();
        if(YII::$app->request->isPost){
            print_r(YII::$app->request->post());
            $model = Category::findOne($_GET['id']);
            $model->cat_name=YII::$app->request->post('cat_name');
            $model->parent_id=YII::$app->request->post('parent_id');
            if ($model->save()) {
                echo "修改成功";
                die;
            }else{
                echo "失败";
                die;
            }

        }
        $data=$model->find()->asArray()->all();
        $tree=$model->_tree($data);
        return $this->render('edit',['tree'=>$tree]);
    }

    public function actionDel(){
        if(YII::$app->request->isGet){
            $model=new Category();
            //遍历删除该分类及其子类
            $model=new Category();
            $data=$model->getChildren(YII::$app->request->get('id'));
            $data[]=YII::$app->request->get('id');
            foreach($data as $v){
                $model->deleteAll(['id'=>$v]);
            }
        }
    }

    public function actionGet(){
        $model=new Category();
        $data=$model->getChildren('2');
        print_r($data);
    }

}
