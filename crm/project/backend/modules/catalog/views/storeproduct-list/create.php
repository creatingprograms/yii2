<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\StoreProduct */

$this->title = 'Create Store Product';
$this->params['breadcrumbs'][] = ['label' => 'Store Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
