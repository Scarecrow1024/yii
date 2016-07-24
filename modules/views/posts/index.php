<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;
    use app\models\Posts;

	$this->context->layout = 'register';
?>
<?php $model = new Posts();?>
<?php $form=ActiveForm::begin([
        'action' => ['add'],
        'method' => 'post',
    ]);?>
    <tr>
        <td>所属分类：</td>
        <td>
            <select name="cat_name" class="form-control">
                <option value="0">顶级分类</option>
                <?php foreach ($tree as $k => $v): ?>
                <option value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 3*$v['lev']) . $v['cat_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($model, 'title')?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(),[
                'clientOptions' => [
                    'imageManagerJson' => ['/redactor/upload/image-json'],
                    'imageUpload' => ['/redactor/upload/image'],
                    'fileUpload' => ['/redactor/upload/file'],
                    'lang' => 'zh_cn',
                    'plugins' => ['clips', 'fontcolor','imagemanager']
                ]
            ]) ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($model, 'status')->radioList(['0'=>'编辑','1'=>'发布'])?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $form->field($model, 'image')->fileInput() ?>
        </td>
    </tr>
    <div class="form-group">
        <?= Html::submitButton('发布',['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end();?>