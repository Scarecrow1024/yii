<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	//use app\models\Login;
	use yii\captcha\Captcha;
?>

<?php $form=ActiveForm::begin([
        'action' => ['login'],
        'method' => 'post',
    ]);?>
<?= $form->field($model,'username')->textInput()?>
<?= $form->field($model,'password')->passwordInput()?>
<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
    'template' => '<div class="row"><div class="col-lg-6">{input}</div><div class="col-lg-3">{image}</div></div>',
    'captchaAction' => '/admin/login/captcha',
]) ?>
<div class="from-group">
	<?= Html::submitButton('Login',['class' => 'btn btn-primary'])?>
</div>
<?php ActiveForm::end();?>