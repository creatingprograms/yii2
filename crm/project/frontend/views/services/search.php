<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\StoreProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'producer_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'sku') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
