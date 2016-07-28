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
	<table cellspacing="1" class="table" cellpadding="3" width="100%">
            <tr>
                <td>角色列表：</td>
                <td>
                    <?php foreach ($roleData as $k => $v): ?>
                        <input type="checkbox" name="role_id[]" value="<?php echo $v['id']; ?>" />
                        <?php echo $v['role_name']; ?>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td>用户名：</td>
                <td>
                    <input  type="text" class="form-control" name="username" value="" />
                </td>
            </tr>
            <tr>
                <td>密码：</td>
                <td>
                    <input type="password" class="form-control" size="25" name="password" />
                </td>
            </tr>
            <tr>
                <td>确认密码：</td>
                <td>
                    <input type="password" class="form-control" size="25" name="cpassword" />
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
</div>
<?php ActiveForm::end();?>