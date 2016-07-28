<?php
namespace vendor\event;
use \yii\base\Component;
class Mourse extends Component{
	public function run($event){
		echo $event->data;
		echo " running<br>";
	}
}