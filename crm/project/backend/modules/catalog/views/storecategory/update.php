<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreCategory */

$this->title = 'Редактировать категорию магазина: ' . $model->title;
?>
<div class="store-category-update">
    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
