<?php

namespace app\modules\controllers;

use yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Posts;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * Default controller for the `admin` module
 */
class PostsController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layouts='register';
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $model=new Category();
        $data=$model->find()->asArray()->all();
        $tree=$model->_tree($data);
        //print_r($tree);
    	$csrfToken=YII::$app->request->csrfToken;
		return $this->render('index',['tree'=>$tree]);
    }

    public function actionLst(){
        $model=new Posts();
        $data=$model->find()->asArray()->all();
        return $this->render('lst',['data'=>$data]);
    }


    public function actionAdd(){
        $model = new Posts();
        if (Yii::$app->request->isPost) {
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->upload()) {
                $filename=$_FILES['Posts']['name']['image'];
                $img=new Image();
                $img->thumbnail('uploads/'.$filename,200,100)
                //->rotate(-8)
                ->save('uploads/'."tiny_".$filename, ['quality' => 50]);

                $img->thumbnail('uploads/'.$filename,280,160)
                ->rotate(-8)
                ->save('uploads/'."mid_".$filename, ['quality' => 50]);

                $model->add_time=time();
                $model->cat_name=YII::$app->request->post('cat_name');
                $model->title=YII::$app->request->post('Posts')['title'];
                $model->content=YII::$app->request->post('Posts')['content'];
                $model->status=YII::$app->request->post('Posts')['status'];
                $model->tiny_img= "tiny_".$filename;
                $model->mid_img= "mid_".$filename;
                $model->insert();
            }
        }
    }

    public function actionEdit(){
        $model=new Posts();
        if(YII::$app->request->isPost){
            $model = Posts::findOne($_GET['id']);
            $model->cat_name=YII::$app->request->post('cat_name');
            $model->title=YII::$app->request->post('Posts')['title'];
            $model->content=YII::$app->request->post('Posts')['content'];
            $model->status=YII::$app->request->post('Posts')['status'];
            $model->image=$_FILES['Posts']['name']['image'];
            if ($model->save()) {
                echo "修改成功";
                die;
            }else{
                echo "失败";
                die;
            }

        }
        $tree=new Category();
        $data=$tree->find()->asArray()->all();
        $tree=$tree->_tree($data);
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
