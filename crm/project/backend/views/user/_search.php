<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
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
	
	
    <?= $form->field($model, 'active')->checkbox([ 'class' => 'input__checkbox', 'label' => null])->label('Исключить неактивных клиентов', ['class' => 'input__checkbox-label active_checked']) ?>
	<p class="summary_act"></p>
	
	<div class="form--search form">
		<?= $form->field($model, 'username')->textInput(['maxlength' => true, 'class' => 'input__elem has-content', 'placeholder' => 'Поиск'])->label(false) ?>

		<?php // $form->field($model, 'auth_key') ?>

		<?php // $form->field($model, 'password_hash') ?>

		<?php // $form->field($model, 'password_reset_token') ?>

		<?php // echo $form->field($model, 'email') ?>

		<?php // echo $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<?php // echo $form->field($model, 'verification_token') ?>

		<?php // echo $form->field($model, 'name') ?>

		<?php // echo $form->field($model, 'surname') ?>

		<?php // echo $form->field($model, 'patronymic') ?>

		<?php // echo $form->field($model, 'phone') ?>


		<?= Html::submitButton('', ['class' => 'btn btn--light btn--search']) ?>
	</div>

</div>
    <?php ActiveForm::end(); ?>

