<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
use kartik\file\FileInput;
use backend\models\UploadForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreAttributeGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-attribute-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <div class="row margin-bottom-11">
        <div class="col-md-9 col-sm-9">
            <?= $form->field($model, 'upload_image')->widget(FileInput::className(), [
                'options' => ['accept'=>'image/*'],
                'pluginOptions' => [
                    'initialPreview'=> !empty($model->imageFile)? Html::img("/uploads/images/" . $model->imageFile) : '',
                    'overwriteInitial'=>true
                ],
            ]); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
