<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pageblock */

$this->title = 'Update Pageblock: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pageblocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pageblock-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
