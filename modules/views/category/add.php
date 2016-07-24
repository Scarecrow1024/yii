<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Category;
	$this->context->layout = 'register';
?>
<?php $model = new Category();?>
<?php $form=ActiveForm::begin([
        'action' => ['add'],
        'method' => 'post',
    ]);?>
<div class="from-group">
	<table  class="table table-hover table-bordered">
            <tr>
                <td>上级分类：</td>
                <td>
                    <select name="parent_id" class="form-control">
                        <option value="0">顶级分类</option>
                        <?php foreach ($tree as $k => $v): ?>
                        <option value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 3*$v['lev']) . $v['cat_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>分类名称：</td>
                <td>
                    <?= $form->field($model, 'cat_name')?>
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <?= Html::submitButton('添加',['class' => 'btn btn-primary']) ?>
                    <input type="reset" class="btn btn-info" value=" 重置 " />
                </td>
            </tr>
        </table>
</div>
<?php ActiveForm::end();?>