<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Register;
	$this->context->layout = 'register';
?>
<?php $model = new Register();?>
<?php $form=ActiveForm::begin([
        'action' => ['register'],
        'method' => 'post',
    ]);?>
<?= $form->field($model,'username')->textInput()?>
<?= $form->field($model,'email')->textInput()?>
<?= $form->field($model,'password')->passwordInput()?>
<?= $form->field($model,'repassword')->passwordInput()?>
<div class="from-group">
	<?= Html::submitButton('Register',['class' => 'btn btn-primary'])?>
</div>
<?php ActiveForm::end();?>