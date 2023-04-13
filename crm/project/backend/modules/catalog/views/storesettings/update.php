<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreSettings */

$this->title = 'Update Store Settings: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
