<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Role;
	$this->context->layout = 'register';
?>
<?php $model = new Role();?>
<?php $form=ActiveForm::begin([
        'method' => 'post',
    ]);?>
<div class="from-group">
	<table class="table" cellpadding="3" cellspacing="1">
        <tr>
            <th>角色名称</th>
            <th>权限列表</th>
            <th>操作</th>
        </tr>
        <?php for($i=0;$i<count($array[0]);$i++){?>
            <tr>
                <td><?php echo $array[0][$i]?></td>
                <td><?php echo $array[1][$i]['pri_name']?></td>
                <td>
                    <a href="" title="编辑">编辑</a> |
                    <a href="" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
                </td>
            </tr>
        <?php }?>
    </table>
</div>
<?php ActiveForm::end();?>