<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProductLink */

$this->title = 'Create Store Product Link';
$this->params['breadcrumbs'][] = ['label' => 'Store Product Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-product-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
