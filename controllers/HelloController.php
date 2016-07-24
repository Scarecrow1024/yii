<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\EntryForm;
use app\models\Info;
use app\models\Order;
use app\models\Giitest;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\db\Query;
use yii\web\UploadedFile;
use vendor\event\Cat;
use vendor\event\Mourse;
use yii\base\Event;
use app\behaviors\Behavior1;
use yii\imagine\Image;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use yii\helpers\FileHelper;
use yii\captcha\CaptchaAction;

class HelloController extends Controller{
	public function actionCache(){
		//分片缓存
		return $this->render('cache');
	}

	public function actionMail(){
		$mail= Yii::$app->mailer->compose('mail',[ 
		    'html' => 'html', //key固定,value是模版文件名 
		    'title' => '22' 
		]);  
		//$mail->attach('/yii/composer.json');
		$mail->setTo('819681825@qq.com');  
		$mail->setSubject("邮件测试");  
		//使用模板的话就不能使用setHtmlBody()
		$mail->setTextBody('测试的邮件 ');   //发布纯文字文本
		//$mail->setHtmlBody("<h1>测试的邮件</h1>");    //发布可以带html标签的文本
		if($mail->send())  
		    echo "success";  
		else  
		    echo "failse";   
		die();
	}

	public function actionUrl(){
		print_r(YII::$app->request->getPathInfo());
		$url=new Url();
		echo Url::to('uploads/images/logo.gif',true);
	}

	public function actionDir(){
		print_r(FileHelper::findFiles('uploads'));
	}

	public function actionStr(){
		$path="http://www.php.net/manual/en/function.basename.php.";
		echo StringHelper::basename( $path, $suffix = '' )."<br>";
		echo StringHelper::byteLength($path)."<br>";
		echo StringHelper::byteSubstr($path,0,10)."<br>";
		echo StringHelper::dirname($path)."<br>";
	}

	//ArrayHelper类的使用
	public function actionArr_help(){
		$arr_help=new ArrayHelper();
		$array=array(
				'pop1'=>['name'=>"niool",
				'age'=>21
				],
				'pop2'=>['name'=>'yanfei',
				'age'=>22
				]
			);
		/*/获取一个值
		echo $arr_help->getValue($array,'pop1.name');
		*/
		/*/从数组中删除一个值
		$arr_help->remove($array,'name');
		print_r($array);
		*/
		/*/从多行数据中获取某一列的值
		$ids = ArrayHelper::getColumn($array, 'name');
		print_r($ids);
		*/
		/*/重建数组索引，把id的值当成索引
		$array = [
				    ['id' => '123', 'data' => 'abc', 'device' => 'laptop'],
				    ['id' => '345', 'data' => 'def', 'device' => 'tablet'],
				    ['id' => '345', 'data' => 'hgi', 'device' => 'smartphone'],
				];
		$result = ArrayHelper::index($array, 'id');
		print_r($result);
		*/	
		/*/multisort 方法可用来对嵌套数组或者对象数组进行排序，可按一到多个键名排序，比如
		$data = [
				    ['age' => 30, 'name' => 'Alexander'],
				    ['age' => 32, 'name' => 'Brian'],
				    ['age' => 19, 'name' => 'Barney'],
				];
		print_r($arr_help->multisort($data, ['age', 'name'], [SORT_ASC, SORT_DESC]));
		*/
	}

	//图象处理类
	public function actionImage(){
		$img=new Image();
		$img//->frame('uploads/demo.jpg', 5, '666', 0)
		//->crop('uploads/demo.jpg',200,100)
		->thumbnail('uploads/demo.jpg',200,100)
	    //->rotate(-8)
	    ->save('uploads/crop_demo.jpg', ['quality' => 50]);
	}

	//查询生成器的使用
	public function actionDemo(){
		$query=new Query;
		$res=$query->select('*')
		->from('giitest')
		//这样可以防sql注入
		//->where('name=:name',[':name'=>'yanfei'])
		->where(['>','id',1])
		//->andWhere(['email'=>'yanfei@qq.com'])
		//去重
		->distinct()
		->orderBy(['name' => SORT_DESC])
		->all();
		print_r($res);
	}

	public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	public function actionForm(){
		//$this->layout=false;
		if(YII::$app->request->isPost){
			//echo Html::encode(YII::$app->request->post('title'));
			return $this->render('form');
		}else{
			$csrfToken=YII::$app->request->csrfToken;
			return $this->render('index',['csrf'=>$csrfToken]);
		}
	}

	public function actionGiitest(){
		$gii=new Giitest;
		$gii->name='niool';
		$gii->email='819681825@qq.com';
		if($gii->validate()){
			$gii->insert();
		}else{
			print_r($gii->getErrors());
		}
	}

	public function behaviors(){
		return [
			//过滤器，只允许注册的用户访问依稀方法
			'access' => [
	            'class' => \yii\filters\AccessControl::className(),
	            'only' => ['index', 'upd'],
	            'rules' => [
	                // 允许认证用户
	                [
	                    'allow' => true,
	                    'roles' => ['@'],
	                ],
	                // 默认禁止其他用户
	            ],        
	        ],
	        'verbs' => [
	            'class' => \yii\filters\VerbFilter:: className(),
	            'actions' => [
	                 'find' => [ 'get'],            //只允许get方式访问
	                 //'create' => [ 'post'],          //只允许用post方式访问
	                 //'update' => [ 'post']
	             ],
        	],
			[
				'class'=>'yii\filters\PageCache',
				'only'=>['page','cache'],
				'duration'=>10,
				'dependency'=>[
					'class'=>'yii\caching\DbDependency',
					'sql'=>'select COUNT(*) from info',
				],
			],
		];
	}

	public function actionPage(){
		$model=new Info();
		$infos=$model->find()->asArray()->all();
		$count=$model->find()->count();
		$pages = new Pagination(['validatePage' => false,'pageParam' => 'p','defaultPageSize' => 2,'totalCount' => $count]);
		$models = $model->find()->offset($pages->offset)
    	->limit($pages->limit)
    	->asArray()
    	->all();
    	return $this->render('page', [
				    'models' => $models,
				    'pages' => $pages,
				]);
		//print_r($infos);
		//分页缓存
		echo "PageCache!!!";
	}

	/*public function actions() {
        return [
            'captcha' =>  [
                'class' => '\yii\captcha\CaptchaAction',
                'height' => 50,
                'width' => 80,
                'minLength' => 3,
                'maxLength' => 5
            ],
        ];
    }*/

    public function actionUploads()
    {
        $model = new Info();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // 文件上传成功
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionUpload(){
    	$model = new Info;

	    if (\Yii::$app->request->isPost) {
	        $model->file = UploadedFile::getInstance($model, 'file');
	        
	        if ($model->file) {
	            $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
	        }
	    }

    	return $this->render('upload', ['model' => $model]);
    }

	 public function actionCaptcha(){
	 	$model=new Info();
	 	return $this->render('captcha',['model'=>$model]);
	 }

	public function actionSay(){
		//$request=YII::$app->request;
		//echo $request->get('id');
		$str=array('str'=>"yii<script>alert('lala');</script>");
		//不显示布局文件
		//$this->layout=false;
		$csrfToken=YII::$app->request->csrfToken;
		return $this->render('index',['csrf'=>$csrfToken,'str'=>$str]);
	}

	public function actionFind(){
		$info=new Info;
		//$sql="select * from info";
		//$res=$info->findBySql($sql)->asArray()->all();
		$res=$info->find()->select(['name'])->where(['>','id',1])->all();
		print_r($res);
		/*foreach($info->find()->asArray()->batch(1) as $ret){
			//每次拿一条要拿5次
			print_r(count($ret));
		}*/
	}

	public function actionInsert(){
		$info=new Info;
		$info->id=6;
		$info->name='feilala';
		if($info->validate()){
			if($info->insert()){
				echo "插入成功";
			}else{
				print_r($info->getErrors());
			}
		}else{
			print_r($info->getErrors());
		}
	}

	public function actionDel(){
		$info=new Info;
		if($info->deleteAll(['id'=>5])){
			echo "删除成功";
		}else{
			echo "删除失败";
		}
	}

	public function actionUpd(){
		$info=new Info;
		/*$info->on('nio',function($event){
			echo "nio";
		});
		$info->trigger('nio');*/
		//$res=$info->findOne(1);
		//print_r($res);die;
		$res=$info->find()->where(['=','id',3])->one();
		$res->name='jiaoer';
		if($res->save()){
			echo "修改成功";
		}else{
			echo "修改失败";
		}
	}

	public function actionJoin(){
		$info=new Info;
		//要作为对象使用使用with来提高效率
		$infos=$info->find()->with('orders')->where(['name'=>'niool'])->all();
		foreach($infos as $info){
			$res=$info->orders;
			print_r($res);
		}
		die;
		//$res=$info->hasMany(Order::className(),['uid'=>'id'])->asArray()->all();
		//原理：info对象调用一个不存在的属性会激活__get方法然后会去寻找getOrders方法
		$res=$info->orders;
		print_r($res);
	}

	public function actionEntry(){
		$model=new EntryForm();
		$model->name='niool';
		$model->email='niool@qq.com';
		if($model->validate()){
			echo "验证成功";
		}else{
			echo "false";
		}
	}

	public function actionMaopao(){
		$data=array(1,3,5,2,8,6,12,10);
		for($i=1;$i<count($data);$i++){
			for($k=1;$k<count($data)-1;$k++){
				if($data[$k]>$data[$k+1]){
					$tmp=$data[$k+1];
					$data[$k+1]=$data[$k];
					$data[$k]=$tmp;
				}
			}
		}
		print_r($data);
	}

	public function actionSort(){
		$data=array(1,3,5,2,8,6,12,10);
		sort($data);
		print_r($data);
	}

	//事件绑定
	public function actionEvent(){
		$cat=new Cat;
		$mourse=new Mourse;
		$cat->on('miao',[$mourse,'run'],'pa');
		//类级别的绑定，当每一个实例触发miao事件的时候都会调用run方法
		//Event::on(Cat::className(),'miao',[$mourse,'run']);
		$cat->on(Cat::MIAO_EVENT,[$cat,'eat'],'',false);
		$cat->on('eat',[$cat,'bind']);
		//$cat->off('miao',[$mourse,'run']);
		$cat->shout();
		$cat2=new Cat;
		$cat2->shout();
		//类的混合
		//$cat->sleep();
		//对象的混合
		$behavior1=new Behavior1();
		$cat->attachBehavior('beha1',$behavior1);
		$cat->shout();
		//让cat触发wang的事件
		$cat->trigger('wang');
		die;
		YII::$app->on(\yii\base\Application::EVENT_AFTER_REQUEST,[$cat,'shout']);
		echo "miaomioamiao<br>";
	}
}

