<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Document;
use kartik\file\FileInput;
use dosamigos\multiselect\MultiSelect;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
	'fieldConfig' => [
		'template' => "{input}{label}{error}",
			'options' => [
				'class' => 'input form-group'
			]
],
]); ?>
<div class="project-form">
	<div class="form__row form__row--two border_bottom">
		<div class="input form-group no-imput">
			<?= $form->field($model, 'type', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Требуется согласовать', ['class' => 'input__elem-label'])->checkbox(['checked'=>false])?>
		</div>
		<div class="input form-group no-imput a-input"><a href="#">Вложенные файлы</a></div>
	</div>
	<div class="form__row form__row--two border_bottom">
		<div class="input form-group no-imput">
			<?= $form->field($model, 'unic_file', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Требуется документ от клиента', ['class' => 'input__elem-label'])->checkbox(['checked'=>false])?>
		</div>
		<div class="input form-group no-imput a-input"><p style="font-size:12px;">*Сгенерируется уникальная ссылка на загрузку документа от клиента</p></div>
	</div>
	<div class="form__row form__row--two">
		<div class="input form-group no-imput"><p>Вложение</p></div>
		<div class="input form-group no-imput"><p>Заголовок</p></div>

		<?php if(isset($model->document_id)){ ?>
			<?= $form->field($model, 'upload_doc')->label('Документ', ['class' => 'input__elem-label'])->widget(FileInput::className(), [
				'options' => ['accept'=>'doc/*'],
				'pluginOptions' => [
					'initialPreview'=> !empty($model->document_id)? Html::img("/uploads/documents/" . Document::find()->where(['id' => $model->document_id])->one()->title) : '',
					'overwriteInitial'=>true
				],
			]); ?>
		<?php }else{ ?>
            
            <!-- input file block -->
			<?= $form->field($model, 'upload_doc')->fileInput(['class' => 'upload_doc_ev upload_doc_ev2'])->label(false); ?>

			<div class="input form-group d-flex">
                <div class="w-100">
                    <input class="input__elem" type="textInput" name="serv2" value="" placeholder="Название файла" checked>
                </div>
                <div>
                    <span class="remove--upload btn btn-close">-</span>
                </div>
            </div>
            <!-- end input file block -->

            <div class="input form-group"></div>
            <div class="input form-group text-right">
                <span class="add--upload btn btn-success">+</span>
            </div>
		<?php } ?>
	</div>
	
	<?php if(isset($model->title)){ ?>
		<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Название этапа', ['class' => 'input__elem-label']) ?>
	<?php }else{ ?>
		<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Название этапа', ['class' => 'input__elem-label']) ?>
	<?php } ?>
	
	<div class="form__row form__row--two">
	
		<?php if(isset($model->startdate_at)){ ?>
			<?= $form->field($model, 'startdate_at')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Дата старта', ['class' => 'input__elem-label']) ?>
		<?php }else{ ?>
			<?= $form->field($model, 'startdate_at')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Дата старта', ['class' => 'input__elem-label']) ?>
		<?php } ?>
		<?php if(isset($model->created_at)){ ?>
			<?= $form->field($model, 'created_at')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Дата окончания', ['class' => 'input__elem-label']) ?>
		<?php }else{ ?>
			<?= $form->field($model, 'created_at')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Дата окончания', ['class' => 'input__elem-label']) ?>
		<?php } ?>
	</div>
	<div class="form__row form__row--two">
			<?php if($clients != []){ ?>
				<?= $form->field($model, 'user_id', ['inputOptions'=> ['class' => 'select-styled input__elem has-content auto_complit_project']])->label('Клиент', ['class' => 'input__elem-label'])->dropDownList($clients)?>
			<?php } ?>
			<?php if($sub != []){ ?>
				<?= $form->field($model, 'sub_id', ['inputOptions'=> ['class' => 'select-styled input__elem has-content auto_complit_project']])->label('Субподрядчик', ['class' => 'input__elem-label'])->dropDownList($sub)?>
			<?php } ?>
			<?php if($projects != []){ ?>
				<?= $form->field($model, 'project_id', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Проект', ['class' => 'input__elem-label'])->dropDownList($projects)?>
			<?php } ?>
			<?php if($status != []){ ?>
				<?= $form->field($model, 'status', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Согласованно клиентом', ['class' => 'input__elem-label'])->dropDownList($status)?>
			<?php } ?>
		<?php // echo $form->field($model, 'status')->textarea(['rows' => 6]) ?>
	</div>
	<?php if(isset($model->description)){ ?>
		<?= $form->field($model, 'description')->textarea(['rows' => 6, 'maxlength' => true, 'class' => 'input__elem has-content'])->label('Описание этапа', ['class' => 'input__elem-label']) ?>
		<?php /* echo $form->field($model, 'description')->widget(CKEditor::className(),[
			'editorOptions' => [
				'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
				'inline' => false, //по умолчанию false
			]
		]); */?>
	<?php }else{ ?>
		<?= $form->field($model, 'description')->textarea(['rows' => 6, 'maxlength' => true, 'class' => 'input__elem'])->label('Описание этапа', ['class' => 'input__elem-label']) ?>
		<?php /* $form->field($model, 'description')->label('Описание этапа', ['class' => 'input__elem-label_top'])->widget(CKEditor::className(),[
			'editorOptions' => [
				'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
				'inline' => false, //по умолчанию false
			]
		]);*/ ?>
	<?php } ?>

	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
	<span class="btn btn-close">Закрыть</span>

    <?php ActiveForm::end(); ?>
</div>
