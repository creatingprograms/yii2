<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\UploadForm;
use kartik\file\FileInput;
use dosamigos\multiselect\MultiSelect;

/* @var $this yii\web\View */
/* @var $model backend\models\Record */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="record-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <div class="service-block-blue">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                <p>Добавить изображение</p></a>
                                <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-6 col-sm-6">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <p>Добавить описание и анонс</p></a>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-10 col-sm-10 col-lg-offset-1">
                                            <div class="service-block-blue">
                                                <?= $form->field($model, 'anons')->textarea(['rows' => 6]) ?>
                                            </div>
                                        </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <?php if($infoblocks != []){ ?>
            <?= $form->field($model, 'infoblock_id')->widget(MultiSelect::className(),[
                'options' => [
                    'multiple'=>"multiple"
                ],
                //'value' => [1, 2], // or ['value_1', 'value_3']
                //'name' => 'multi_select',
                'data' => $infoblocks,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,
                        'numberDisplayed' => 2
                    ],
            ]); ?>
            <?php } ?>
        </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <div class="service-block-blue">
                <div class="panel-group" id="accordion5">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                <p>Добавить Файлы</p></a>
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-10 col-sm-10 col-lg-offset-1">
                                            <div class="service-block-blue">
                                                <?= $form->field($model, 'title_file')->textInput(['maxlength' => true]) ?>

                                                <div class="service-block-blue">
                                                    <?= $form->field($model, 'file')->widget(FileInput::className(), [
                                                        'options' => ['accept'=>'file/*', 'multiple' => true],
                                                        'pluginOptions' => [
                                                                'initialPreview'=>$all_file,
                                                                'overwriteInitial'=>true
                                                        ],
                                                    ]); ?>
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
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <div class="service-block-blue">
                <?php if($categories != []){ ?>
                <?= $form->field($model, 'category_id')->widget(MultiSelect::className(),[
                    'options' => [
                        //'multiple'=>"multiple"
                    ],
                    //'value' => [1, 2], // or ['value_1', 'value_3']
                    //'name' => 'multi_select',
                    'data' => $categories,
                    "clientOptions" => 
                        [
                            "includeSelectAllOption" => true,
                            'numberDisplayed' => 2
                        ],
                ]); ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
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
