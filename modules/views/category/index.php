<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Category;
	use yii\helpers\Url;
	$this->context->layout = 'register';
?>
<?php $model = new Category();?>
<?php $form=ActiveForm::begin();?>
<div class="from-group">
	<table  class="table table-hover table-bordered">
            <tr>
                <th style="text-align: center">分类名称</th>
                <th style="text-align: center">操作</th>
            </tr>
            <?php foreach ($tree as $k => $v): ?>
            <tr class="tron">
                <td><?php echo str_repeat('-', 3*$v['lev']) . $v['cat_name']; ?></td>
                <td align="center">
                	<a href="<?php echo Url::to('index.php?r=admin/category/edit&id=').$v['id'];?>">修改</a>
                	<a onclick="return confirm('确定要删除吗？');" href="<?php echo Url::to('index.php?r=admin/category/del&id=').$v['id'];?>">删除</a>
               </td>
            </tr>
            <?php endforeach; ?>
        </table>
</div>
<?php ActiveForm::end();?>