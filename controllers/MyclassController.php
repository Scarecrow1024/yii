<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\base\Component;
use app\controllers\Mybehavior;

class Myclass extends Component{
    // 空的
    public function actionDemo(){
		$myBehavior = new MyBehavior();

		// Step 3: 将行为绑定到类上
		$this->attachBehavior('myBehavior', $myBehavior);

		// Step 4: 访问行为中的属性和方法，就和访问类自身的属性和方法一样
		echo $this->property1;
		echo $this->method1();
    }
}