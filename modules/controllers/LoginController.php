<?php

namespace app\modules\controllers;

use yii;
use yii\web\Controller;
use app\models\Login;
use yii\captcha\Captcha;
/**
 * Default controller for the `admin` module
 */
class LoginController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
            ],
        ];
    }

    public function actionIndex()
    {
        $model=new Login();
    	$csrfToken=YII::$app->request->csrfToken;
		return $this->render('index',['model'=>$model]);
    }

    public function actionDemo(){
        $session = Yii::$app->session;
        $session->open();
        echo $session->get('isLogin');
    }

    public function actionLogout(){
        $session=YII::$app->session;
        $session->open();
        $session->remove('isLogin');
    }

    public function actionChangestatus(){
        $token=YII::$app->request->get('token');
        $model=new Login();
        $model->on('jihuo',function(){
            $model=new Login();
            $token="db99a37cfae7258ce45f162c658c1bd4";
            $sql="update register set status = 1 where 'token' = 'db99a37cfae7258ce45f162c658c1bd4'";
            echo $sql;
            die;
            $res=$model->find()->where("token="."'"."$token"."'")->one();
            $res->status=1;
            if($res->save()){
                echo "ok";
            }else{
                echo "no";
            }
        });
        if(!$model->find()->where("token="."'".$token."'")->one()){
            echo "激活失败";
        }else{   
            $model->trigger('jihuo');
        }
    }

    public function actionLogin(){
        if(YII::$app->request->isPost){
            $model=new Login();
            $username=YII::$app->request->post('Login')['username'];
            $password=YII::$app->request->post('Login')['password'];
            if(!$data=$model->find()->where(['username'=>$username])->asArray()->one()){
                echo "用户不存在";
            }elseif($data['password']==$password){
                //添加一个事件，如果未激活则不登录
                $model->on('status',function(){
                    echo "未激活";
                });
                if($data['status']==0){
                    $model->trigger('status');
                }else{
                    $session = Yii::$app->session;
                    $session->open();
                    $session->set('isLogin', 1, 3600);
                    echo "登陆成功";
                }            
            }
        }else{

        }
    }

}
