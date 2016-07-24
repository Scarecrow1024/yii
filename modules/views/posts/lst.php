<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Posts;
	use yii\helpers\Url;
	$this->context->layout = 'register';
?>
<?php $model = new Posts();?>
<?php $form=ActiveForm::begin();?>
<div class="from-group">
	<table  class="table table-hover table-bordered">
            <tr>
                <th style="text-align: center">标题</th>
                <th style="text-align: center">分类</th>
                <th style="text-align: center">状态</th>
                <th style="text-align: center">操作</th>
            </tr>
            <?php foreach ($data as $k => $v): ?>
            <tr class="tron">
                <td><?php echo $v['title']; ?></td>
                <td><?php echo $v['cat_name']; ?></td>
                <td><?php echo $v['status']; ?></td>
                <td align="center">
                	<a href="<?php echo Url::to('index.php?r=admin/posts/edit&id=').$v['id'];?>">修改</a>
                	<a onclick="return confirm('确定要删除吗？');" href="<?php echo Url::to('index.php?r=admin/posts/del&id=').$v['id'];?>">删除</a>
               </td>
            </tr>
            <?php endforeach; ?>
        </table>
</div>
<?php ActiveForm::end();?>