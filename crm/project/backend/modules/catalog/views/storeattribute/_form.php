<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
use kartik\file\FileInput;
use backend\models\UploadForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreAttribute */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-attribute-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
    <div class="row margin-bottom-11">
        <div class="col-md-3 col-sm-3">
            <?php if($filter != []){ ?>
            <?= $form->field($model, 'group_id')->widget(MultiSelect::className(),[
                //'value' => [1, 2], // or ['value_1', 'value_3']
                //'name' => 'multi_select',
                'data' => $filter,
                "clientOptions" => 
                    [
                        "includeSelectAllOption" => true,
                        'numberDisplayed' => 2
                    ],
            ]); ?>
            <?php } ?>

        </div>
        <div class="col-md-4 col-sm-4">
            <?= $form->field($model, 'upload_image')->widget(FileInput::className(), [
                    'options' => ['accept'=>'image/*'],
                    'pluginOptions' => [
                        'initialPreview'=> !empty($model->param_icon)? Html::img("/uploads/images/default/" . $model->param_icon) : '',
                        'overwriteInitial'=>true
                    ],
                ]);
            ?>
        </div>
    </div>
    
    <div class="row margin-bottom-11">
        <div class="col-md-3 col-sm-3">
            <?php // $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-3 col-sm-3">
            <?php // $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php // $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
