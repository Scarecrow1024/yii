<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Url;
	$this->context->layout = 'register';
?>
<?php $form=ActiveForm::begin();?>
    <table class="table" cellpadding="3" cellspacing="1">
        <tr>
            <th >用户名</th>
            <th >角色列表</th>
            <th>操作</th>
        </tr>
        <?php for($i=0;$i<count($data);$i++){?>            
            <tr>
                <td><?php print_r($data[$i]['username']) ?></td>
                <td><?php echo $data[$i]['role_id']==2?'超级管理员':$data[$i]['role_name']; ?></td>
                <td>
                    <a href="" title="编辑">编辑</a>
                    <?php if($data[$i]['role_id'] != 2): ?>
                     |
                    <a href="" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
                    <?php endif; ?>
                </td>
            </tr>
        <?php }?>
    </table>
    
<?php ActiveForm::end();?>