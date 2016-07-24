<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Giitest */

$this->title = 'Create Giitest';
$this->params['breadcrumbs'][] = ['label' => 'Giitests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giitest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
