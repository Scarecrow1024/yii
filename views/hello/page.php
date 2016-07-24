<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Countries</h1>
<ul>
<?php foreach ($models as $model): ?>
<li>
<?= Html::encode("{$model['name']}") ?>
</li>
<?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pages]) ?>
<?=\app\widgets\hello\HelloWidget::widget(['msg'=>'hello world'])?>