<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use backend\models\UploadForm;
use dosamigos\multiselect\MultiSelect;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Infoblock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="infoblock-form">

   <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?php if($records != []){ ?>
            <?php //echo $form->field($model, 'alias')->widget(MultiSelect::className(),[
                //'options' => [
                    //'multiple'=>"multiple"
                //],
                //'value' => [1, 2], // or ['value_1', 'value_3']
                //'name' => 'multi_select',
                //'data' => $records,
                //"clientOptions" => 
                    //[
                       // "includeSelectAllOption" => true,
                        //'numberDisplayed' => 2
                    //],
            //]); ?>
            <?php } ?>
        </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <div class="service-block-blue">
                <?= $form->field($model, 'upload_image')->widget(FileInput::className(), [
                    'options' => ['accept'=>'image/*'],
                    'pluginOptions' => [
                            'initialPreview'=>Html::img("/uploads/images/" . $model->imageFile),
                            'overwriteInitial'=>true
                    ],
                ]); ?>
            </div>
        </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <div class="service-block-blue">
                <?= $form->field($model, 'description')->widget(CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                    ]
                ]); ?>
            </div>
        </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <div class="service-block-blue">
                <div class="panel-group" id="accordion2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                <p>Дополнительные настройки</p></a>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="service-block-blue">
                                                <?php if($records != []){ ?>
                                                <?= $form->field($model, 'link')->widget(MultiSelect::className(),[
                                                    'options' => [
                                                        'multiple'=>"multiple"
                                                    ],
                                                    //'value' => [1, 2], // or ['value_1', 'value_3']
                                                    //'name' => 'multi_select',
                                                    'data' => $records,
                                                    "clientOptions" => 
                                                        [
                                                            "includeSelectAllOption" => true,
                                                            'numberDisplayed' => 2
                                                        ],
                                                ]); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="service-block-blue">
                                                <?= $form->field($model, 'text_link')->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="service-block-blue">
                                                <?= $form->field($model, 'type')->widget(MultiSelect::className(),[
                                                    'data' => ['1' => 'Визуальный', '2' => 'Текстовый'],
                                                    "clientOptions" => 
                                                        [
                                                            "includeSelectAllOption" => true,
                                                            'numberDisplayed' => 2
                                                        ],
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="service-block-blue">

                                                <?= $form->field($model, 'indexok')->checkbox(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-10 col-sm-10 col-lg-offset-1">
        <div class="service-block-blue">
            <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
        </div>
    </div>

    <div class="col-md-10 col-sm-10 col-lg-offset-1">
        <div class="service-block-blue">
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
