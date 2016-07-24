<?php

namespace app\modules\controllers;

use yii;
use yii\web\Controller;
use app\models\Register;

/**
 * Default controller for the `admin` module
 */
class RegisterController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layouts='register';

    public function actionIndex()
    {
    	$csrfToken=YII::$app->request->csrfToken;
		return $this->render('index',['csrf'=>$csrfToken]);
    }
    public function actionRegister(){
    	$model=new Register();
    	$model->reg_time=time();
    	//构造token
    	$model->token=md5(Yii::$app->request->post('Register')['password']);
    	$session=YII::$app->session;
        $session->open();
        $session->set('token',$model->token);
    	$model->on('send',function(){
        	$mail= Yii::$app->mailer->compose();  
			//$mail->attach('/yii/composer.json');
			$mail->setTo('819681825@qq.com');  
			$mail->setSubject("激活账号");  
			$session=YII::$app->session;
        	$session->open();
        	$token=$session->get('token');
			$url="http://localhost/yii/web/index.php?r=admin/login/changestatus&token=".$token;
			//使用模板的话就不能使用setHtmlBody()
			$mail->setTextBody($url);   //发布纯文字文本
			//$mail->setHtmlBody("<h1>测试的邮件</h1>");    //发布可以带html标签的文本
			if($mail->send())  
			    echo "请查收邮件";  
			else  
			    echo "发送失败，检查邮箱是否正确";   
			die();
        });
    	if($model->load(Yii::$app->request->post()) && $model->save()) {
    		//触发发送邮件事件
    		$model->trigger('send');
        } 
    }

}
