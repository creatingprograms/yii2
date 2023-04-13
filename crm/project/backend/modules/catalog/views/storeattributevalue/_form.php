<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\UploadForm;
use kartik\file\FileInput;
use dosamigos\multiselect\MultiSelect;
use mihaildev\ckeditor\CKEditor;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\StoreAttributeValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-attribute-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'product_id')->textInput() ?>

    <?php // echo $form->field($model, 'attribute_id')->textInput() ?>

    <?php // $form->field($model, 'number_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'string_value')->textInput(['maxlength' => true]) ?>
	
	<?php // $form->field($model, 'upload_image')->widget(FileInput::className(), [
			//'options' => ['accept'=>'image/*'],
			//'pluginOptions' => [
					//'initialPreview'=>Html::img("/uploads/images/" . $model->string_value),
					//'overwriteInitial'=>true
			//],
	//]); ?>

	<?php //$form->field($model, 'text_value')->widget(CKEditor::className(),[
		//'editorOptions' => [
			//'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
			//'inline' => false, //по умолчанию false
		//]
	//]); ?>

    <?php // $form->field($model, 'option_value')->textInput() ?>

    <?php // echo $form->field($model, 'create_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
	

    <?php ActiveForm::end(); ?>

</div>
