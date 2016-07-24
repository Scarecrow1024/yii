<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<html>
	<form action="<?php echo Url::to(['hello/form'])?>" method="post">
		<input type="text" class="" name="title" value="<?= Html::encode('<script>alert("123")</script>') ?>">
		<input type="hidden" name="_csrf" value="<?php echo $csrf?>">
		<input type="submit" name="sub" value="提交">
	</form>
</html>
