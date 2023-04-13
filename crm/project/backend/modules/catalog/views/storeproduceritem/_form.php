<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
use kartik\file\FileInput;
use backend\models\UploadForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProducerItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-producer-item-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row margin-bottom-11">
        <div class="col-md-3 col-sm-3">
            <?php if($producer != []){ ?>
            <?= $form->field($model, 'producer_id')->widget(MultiSelect::className(),[
                //'value' => [1, 2], // or ['value_1', 'value_3']
                //'name' => 'multi_select',
                'data' => $producer,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,
                        'numberDisplayed' => 2
                    ],
            ]); ?>
            <?php } ?>

        </div>
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

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anons')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]
    ]); ?>
    
    <?= $form->field($model, 'type')->widget(MultiSelect::className(),[
        'data' => ['1' => 'Визуальный', '2' => 'Текстовый'],
        "clientOptions" => 
            [
                "includeSelectAllOption" => true,
                'numberDisplayed' => 2
            ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
