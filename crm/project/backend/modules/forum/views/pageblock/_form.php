<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pageblock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pageblock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'infoblock_id')->textInput() ?>

    <?= $form->field($model, 'staticpage_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
