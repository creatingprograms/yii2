<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use backend\models\UploadForm;
use dosamigos\multiselect\MultiSelect;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\InfoblockItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="infoblock-item-form">

   <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <?php if($infoblocks != []){ ?>
            <?= $form->field($model, 'infoblock_id')->widget(MultiSelect::className(),[
                //'value' => [1, 2], // or ['value_1', 'value_3']
                //'name' => 'multi_select',
                'data' => $infoblocks,
                "clientOptions" => 
                    [
                        'numberDisplayed' => 2
                    ],
            ]); ?>
            <?php } ?>
        </div>
    </div>

    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'anons')->textarea(['rows' => 6]) ?>
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
                                <p>Добавить изображения</p></a>
                                <div id="collapse1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-4 col-sm-4">
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
                                        <div class="col-md-8 col-sm-8">
                                            <div class="service-block-blue">
                                                <?= $form->field($model, 'imageFiles')->widget(FileInput::className(), [
                                                    'options' => ['accept'=>'image/*', 'multiple' => true],
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

    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <div class="service-block-blue">
                <div class="panel-group" id="accordion2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                <p>Добавить описание</p></a>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
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

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
