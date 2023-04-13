<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
		'options' => [
			'class' => 'form--search form'
		 ],
		 'fieldConfig' => [
			'template' => "{input}{label}{error}",
			'options' => [
				'class' => 'input'
			]
		],
		
    ]); ?>
<div class="data-table__action">
    <?php // $form->field($model, 'id') ?>

	<div class="form--search form">
		<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input__elem has-content', 'placeholder' => 'Поиск'])->label(false) ?>


    <?php // $form->field($model, 'address') ?>

    <?php // $form->field($model, 'user_id') ?>

    <?php // $form->field($model, 'manager_id') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

		<?= Html::submitButton('', ['class' => 'btn btn--light btn--search']) ?>
	</div>

</div>
    <?php ActiveForm::end(); ?>