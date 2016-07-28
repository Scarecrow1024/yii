<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use app\models\Category;
	$this->context->layout = 'register';
?>
<?php $model = new Category();?>
<?php $form=ActiveForm::begin([
        'method' => 'post',
    ]);?>
<div class="from-group">
    <?php 
        $res=$model->find()->asArray()->where("id=".$_GET['id'])->one();
    ?>
	<table  class="table table-hover table-bordered">
            <tr>
                <td>上级分类：</td>
                <td>
                    <select name="parent_id" class="form-control">
                        <option value="0">顶级分类</option>
                        <?php foreach ($tree as $k => $v): ?>
                            <?php if($v['id'] == $res['parent_id'])
                                    $select = 'selected="selected"';
                                else 
                                    $select = '';?>
                        <option <?php echo $select; ?> value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 3*$v['lev']) . $v['cat_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>分类名称：</td>
                <td>
                    <input type="text" class="form-control" name="cat_name" value="<?php echo $res['cat_name']?>">
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <?= Html::submitButton('修改',['class' => 'btn btn-primary']) ?>
                    <input type="reset" class="btn btn-info" value=" 重置 " />
                </td>
            </tr>
        </table>
</div>
<?php ActiveForm::end();?>