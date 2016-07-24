<?php 
//use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Giitest;
use yii\captcha\Captcha;
use yii\bootstrap\ActiveForm;
$model=new Giitest;
?>
<?php $form=ActiveForm::begin();?>
<?php echo $form->field($model,'name')?>
<?php echo $form->field($model,'email')?>
<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
]) ?>

<?= $form->field($model, 'test3')->widget(\yii\redactor\widgets\Redactor::className(),
        [
            'clientOptions' => [
                'imageManagerJson' => ['/redactor/upload/image-json'],
                'imageUpload' => ['/redactor/upload/image'],
                'fileUpload' => ['/redactor/upload/file'],
                'lang' => 'zh_cn',
                'plugins' => ['clips', 'fontcolor','imagemanager']
            ]
        ]
        ) ?>

<?= $form->field($model, 'test1')->label('文本框的标题') ?>

<?= $form->field($model, 'test2')->passwordInput() ?>    

<?= $form->field($model, 'test3')->textarea(['rows'=>'3']) ?>

<?= $form->field($model, 'test3')->fileInput() ?>

<?= $form->field($model, 'test3')->checkboxList(['0'=>'box1','1'=>'box2']) ?>

<?= $form->field($model, 'test3')->radioList(['0'=>'radio1','1'=>'radio2'])?>

<?= $form->field($model, 'test3')->dropDownList(['1'=>'下拉选项1','2'=>'下拉选项2']) ?>

<?= $form->field($model,'test3')->widget(yii\captcha\Captcha::className())?>

<?= $form->field($model, 'test2', [
     'inputTemplate' => '<div style="margin-left:-40px" class="col-sm-4">{input}{input}</div>',
     'enableLabel'=>false
 ])?>

<div class="form-group">
    <?= Html::submitButton('Login',['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end();?>