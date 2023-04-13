<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">
<?php 
	if(Yii::$app->user->getIdentity()->isUser()){ ?>
	
	<h2><?=$model->title?></h2>
	<p><?=$model->description?></p>
	<p><b>Внимание!</b> Событие является блокирующим, и без его подтверждения работы по объекту продолжаться не могут</p>
    <div class="form-group">
		<?= Html::a(
			'Подтвердить',
			['/notification/matching'],
			['class' => 'btn btn-success act_matching', 'id' => $model->id, 'act' => 1]
		) ?>
		
		
    </div>
    <div class="form-group">
		<?= Html::a(
			'Согласовать',
			['/notification/matching'],
			['class' => 'btn btn-success act_matching', 'id' => $model->id, 'act' => 0]
		) ?>
    </div>	
		
<?php 		
	}else{
?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'manager_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'status_men')->textInput() ?>

    <?= $form->field($model, 'status_ad')->textInput() ?>

    <?= $form->field($model, 'status_us')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();} ?>

</div>
