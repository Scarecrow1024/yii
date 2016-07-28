<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Privilege;
	use yii\helpers\Url;
    app\assets\AppAsset::register($this);
	$this->context->layout = 'register';
?>
<head>
    <?php $this->head()?>
</head>
<?php $model = new Privilege();?>
<?php $form=ActiveForm::begin([
    'method'=>'post',
    ]);?>
    <table class="table" cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td>角色名称：</td>
                <td>
                    <input class="form-control"  type="text" name="role_name" value="" />
                </td>
            </tr>
            <tr>
                <td>权限列表：</td>
                <td>    
                    <?php foreach ($tree as $k => $v): ?>
                        <?php echo str_repeat('-', 4*$v['lev']); ?>
                        <input level_id="<?php echo $v['lev']; ?>" type="checkbox" name="pri_id[]" value="<?php echo $v['id']; ?>" />
                        <?php echo $v['pri_name']; ?><br />
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
<?php ActiveForm::end();?>

