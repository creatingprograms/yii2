<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
use kartik\file\FileInput;
use backend\models\UploadForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-10 col-sm-10 col-lg-offset-1">
        <div class="service-block-blue">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?php if($categories != []){ ?>
            <?= $form->field($model, 'sub_category')->widget(MultiSelect::className(),[
                'data' => $categories,
                "clientOptions" => 
                    [
                        'numberDisplayed' => 2
                    ],
            ]); ?>
            <?php } ?>
            <?php //echo $form->field($model, 'sub_category')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'upload_image')->widget(FileInput::className(), [
                'options' => ['accept'=>'image/*'],
                'pluginOptions' => [
                    'initialPreview'=>Html::img("/uploads/images/" . $model->imageFile),
                    'overwriteInitial'=>true
                ],
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

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
