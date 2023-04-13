<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InfoblockItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="infoblock-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'infoblock_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'anons') ?>

    <?= $form->field($model, 'imageFile') ?>

    <?php // echo $form->field($model, 'allFile') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
