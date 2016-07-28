<?php
namespace vendor\event;
use \yii\base\Component;
use app\behaviors\Behavior1;
class Cat extends Component{

	//把Behavior1中的方法属性注入给Cat类的混合
	/*public function behaviors(){
		return [
			Behavior1::className(),
		];
	}*/

	const MIAO_EVENT = 'miao';
	public function shout(){
		echo "miao miao miao<br>";
		$this->trigger('miao');
	}

	public function bind(){
		echo "运行我的时候猫会叫的！！！<br>";
		$this->trigger('mi');
	}

	public function eat(){
		echo "eat eat!!<br>";
		//$this->trigger('miao');
		$this->trigger('eat');
	}
}