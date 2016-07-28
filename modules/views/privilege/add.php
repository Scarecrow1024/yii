<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Privilege;
	$this->context->layout = 'register';
?>
<?php $model = new Privilege();?>
<?php $form=ActiveForm::begin([
        'method' => 'post',
    ]);?>
<div class="from-group">
	<table  class="table table-hover table-bordered">
            <tr>
                <td>上级权限：</td>
                <td>
                    <select name="parent_id" class="form-control">
                        <option value="0">顶级权限</option>
                        <?php foreach ($tree as $k => $v): ?>
                        <option value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 3*$v['lev']) . $v['pri_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>权限名称：</td>
                <td>    
                    <input type="text" class="form-control" name="pri_name">
                </td>
            </tr>
            <tr>
                <td>模块名称：</td>
                <td>
                    <input type="text" class="form-control" name="model">
                </td>
            </tr>
            <tr>
                <td>控制器名称：</td>
                <td>
                    <input type="text" class="form-control" name="controller">
                </td>
            </tr>
            <tr>
                <td>方法名称：</td>
                <td>
                    <input type="text" class="form-control" name="action">
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