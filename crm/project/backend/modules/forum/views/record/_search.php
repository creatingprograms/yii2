<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'imageFile') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'alias') ?>
    
    <?= $form->field($model, 'anons') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'description1') ?>

    <?php // echo $form->field($model, 'description2') ?>

    <?php // echo $form->field($model, 'description3') ?>

    <?php // echo $form->field($model, 'description4') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'content1') ?>

    <?php // echo $form->field($model, 'content2') ?>

    <?php // echo $form->field($model, 'content3') ?>

    <?php // echo $form->field($model, 'content4') ?>

    <?php // echo $form->field($model, 'infoblock_id') ?>

    <?php // echo $form->field($model, 'title_file') ?>

    <?php // echo $form->field($model, 'allFile') ?>

    <?php // echo $form->field($model, 'title_file1') ?>

    <?php // echo $form->field($model, 'allFile1') ?>

    <?php // echo $form->field($model, 'title_file2') ?>

    <?php // echo $form->field($model, 'allFile2') ?>

    <?php // echo $form->field($model, 'title_file3') ?>

    <?php // echo $form->field($model, 'allFile3') ?>

    <?php // echo $form->field($model, 'title_file4') ?>

    <?php // echo $form->field($model, 'allFile4') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'structure') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
