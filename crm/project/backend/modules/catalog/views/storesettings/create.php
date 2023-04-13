<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreSettings */

$this->title = 'Create Store Settings';
$this->params['breadcrumbs'][] = ['label' => 'Store Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
