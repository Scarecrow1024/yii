<?php
namespace app\Behaviors;

use yii\base\Behavior;

class Behavior1 extends Behavior{
	//绑定一个wang的事件调用shout方法
	public function events(){
		return [
			'wang'=>'shout'
			];
	}

	public function shout($event){
		echo "wang wang wang<br>";
	}

	public function sleep(){
		echo "cat need sleep<br>";
	}
}