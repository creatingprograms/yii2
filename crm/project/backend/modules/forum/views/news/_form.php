<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use backend\models\UploadForm;
use kartik\file\FileInput;
use dosamigos\multiselect\MultiSelect;

/* @var $this yii\web\View */
/* @var $model backend\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form row">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <div class="row margin-bottom-11">
        <div class="col-md-4 col-sm-4 col-lg-offset-1">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3 col-sm-3">
			<?= $form->field($model, 'stock')->checkbox([ 'value' => '1', 'checked ' => false])->label('') ?>
        </div>
        <div class="col-md-11 col-sm-11 col-lg-offset-1">
            <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>
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
                            <p>Добавить изображения и файлы</p></a>
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
                                    <div class="col-md-12 col-sm-12">
                                        <div class="service-block-blue">
                                            <?= $form->field($model, 'docFiles')->widget(FileInput::className(), [
                                                    'options' => ['accept'=>'file/*', 'multiple' => true],
                                                    'pluginOptions' => [
                                                            'initialPreview'=>$doc_file,
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
                                    <div class="col-md-10 col-sm-10 col-lg-offset-1">
                                        <div class="service-block-blue">
                                            <?= $form->field($model, 'text')->widget(CKEditor::className(),[
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
