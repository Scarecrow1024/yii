<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Privilege;
	use yii\helpers\Url;
	$this->context->layout = 'register';
?>
<?php $model = new Privilege();?>
<?php $form=ActiveForm::begin();?>
    <table class="table" cellpadding="3" cellspacing="1">
        <tr>
            <th >权限名称</th>
            <th >模块名称</th>
            <th >控制器名称</th>
            <th >方法名称</th>
            <th >上级权限Id</th>
            <th >操作</th>
        </tr>  
        <?php foreach($tree as $v){?>  
        <tr>
            <td><?php echo str_repeat('-', 3*$v['lev']); ?><?php echo $v['pri_name']; ?></td>
            <td><?php echo $v['model']?></td>
            <td><?php echo $v['controller']?></td>
            <td><?php echo $v['action']?></td>
            <td><?php echo $model->find()->asArray()->where(['id'=>$v['parent_id']])->one()['pri_name'] ?></td>
            <td>
                <a href="" title="编辑">编辑</a> |
                <a href="" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
            </td>
        </tr>
        <?php }?>
    </table>
    
<?php ActiveForm::end();?>