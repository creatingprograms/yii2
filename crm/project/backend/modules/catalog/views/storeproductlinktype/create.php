<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProductLinkType */

$this->title = 'Create Store Product Link Type';
$this->params['breadcrumbs'][] = ['label' => 'Store Product Link Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-product-link-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
