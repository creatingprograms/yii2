<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;

/* @var $this yii\web\View */
/* @var $model backend\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
	'fieldConfig' => [
		'template' => "{input}{label}{error}",
],
]); ?>
<div class="document-form">

	<?php if(isset($model->title)){ ?>
		<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Название', ['class' => 'input__elem-label']) ?>
	<?php }else{ ?>
		<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Название', ['class' => 'input__elem-label']) ?>
	<?php } ?>

    <?php // $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
	
	<?php if(isset($model->project_id)){ ?>
			<?php if($projects != []){ ?>
			<?= $form->field($model, 'project_id')->label('Объект', ['class' => 'input__elem-label'])->widget(MultiSelect::className(),[
				'options' => [
					//'multiple'=>"multiple"
				],
				//'value' => [1, 2], // or ['value_1', 'value_3']
				//'name' => 'multi_select',
				'data' => $projects,
				"clientOptions" => 
					[
						"includeSelectAllOption" => true,
						'numberDisplayed' => 2
					],
			]); ?>
			<?php } ?>
	<?php }else{ ?>
			<?php if($projects != []){ ?>
			<?= $form->field($model, 'project_id')->label('Объект', ['class' => 'input__elem-label'])->widget(MultiSelect::className(),[
				'options' => [
					//'multiple'=>"multiple"
				],
				//'value' => [1, 2], // or ['value_1', 'value_3']
				//'name' => 'multi_select',
				'data' => $projects,
				"clientOptions" => 
					[
						"includeSelectAllOption" => true,
						'numberDisplayed' => 2
					],
			]); ?>
			<?php } ?>
	<?php } ?>
		<?php if(isset($model->event_id)){ ?>
			<?php if($events != []){ ?>
			<?= $form->field($model, 'event_id')->label('Событие', ['class' => 'input__elem-label'])->widget(MultiSelect::className(),[
				'options' => [
					//'multiple'=>"multiple"
				],
				'value' => [$model->event_id], // or ['value_1', 'value_3']
				//'name' => 'multi_select',
				'data' => $events,
				"clientOptions" => 
					[
						"includeSelectAllOption" => true,
						'numberDisplayed' => 2
					],
			]); ?>
			<?php } ?>
	<?php }else{ ?>
			<?php if($events != []){ ?>
			<?= $form->field($model, 'event_id')->label('Событие', ['class' => 'input__elem-label'])->widget(MultiSelect::className(),[
				'options' => [
					//'multiple'=>"multiple"
				],
				'value' => [$model->event_id], // or ['value_1', 'value_3']
				//'name' => 'multi_select',
				'data' => $events,
				"clientOptions" => 
					[
						"includeSelectAllOption" => true,
						'numberDisplayed' => 2
					],
			]); ?>
			<?php } ?>
	<?php } ?>

    <?php // $form->field($model, 'event_id')->textInput() ?>

		<?php if(isset($model->type_id)){ ?>
				<?php if($type != []){ ?>
				<?= $form->field($model, 'type_id')->label('Тип документа', ['class' => 'input__elem-label'])->widget(MultiSelect::className(),[
					'options' => [
						//'multiple'=>"multiple"
					],
					//'value' => [1, 2], // or ['value_1', 'value_3']
					//'name' => 'multi_select',
					'data' => $type,
					"clientOptions" => 
						[
							"includeSelectAllOption" => true,
							'numberDisplayed' => 2
						],
				]); ?>
				<?php } ?>
		<?php }else{ ?>
				<?php if($type != []){ ?>
				<?= $form->field($model, 'type_id')->label('Тип документа', ['class' => 'input__elem-label'])->widget(MultiSelect::className(),[
					'options' => [
						//'multiple'=>"multiple"
					],
					//'value' => [1, 2], // or ['value_1', 'value_3']
					//'name' => 'multi_select',
					'data' => $type,
					"clientOptions" => 
						[
							"includeSelectAllOption" => true,
							'numberDisplayed' => 2
						],
				]); ?>
				<?php } ?>
		<?php } ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

	<p>Ссылка для клиента на добавление данного документа: <?= Yii::$app->controller->action->id == 'create' ? '<b>После сохранения здесь появится ссылка на документ</b>' : Yii::$app->request->absoluteUrl ?></p>

</div>
