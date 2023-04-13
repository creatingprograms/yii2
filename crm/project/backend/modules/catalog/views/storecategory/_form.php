<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
use kartik\file\FileInput;
use backend\models\UploadForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
    
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Описание страницы</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Сео настройки</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                
                <div class="row margin-bottom-11">
                    <div class="col-md-6 col-sm-6">
						<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
						<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                    </div>
				</div>
                <div class="row margin-bottom-11">
                    <div class="col-md-0 col-sm-0">
                        <?php // if($categories != []){ ?>
                        <?php // echo $form->field($model, 'parent_id')->widget(MultiSelect::className(),[
                            //'value' => [1, 2], // or ['value_1', 'value_3']
                            //'name' => 'multi_select',
                            //'data' => $categories,
                            //"clientOptions" => 
                                //[
                                    //"includeSelectAllOption" => true,
                                    //'numberDisplayed' => 2
                                //],
                        //]); ?>
                        <?php //} ?>

                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'upload_image')->widget(FileInput::className(), [
                            'options' => ['accept'=>'image/*'],
                            'pluginOptions' => [
                                'initialPreview'=> !empty($model->imageFile)? Html::img("/uploads/images/" . $model->imageFile) : '',
                                'overwriteInitial'=>true
                            ],
                        ]); ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <?= $form->field($model, 'parent_id')->widget(MultiSelect::className(),[
                            'options' => [
                                'multiple'=>false
                            ],
                            //'value' => [1, 2], // or ['value_1', 'value_3']
                            //'name' => 'multi_select',
                            'data' => $categories,
                            "clientOptions" => 
                                [
                                    "includeSelectAllOption" => false,
                                    'numberDisplayed' => 2
                                ],
                        ]); ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
						<?= $form->field($model, 'type')->widget(MultiSelect::className(),[
							'data' => ['1' => 'Визуальный', '2' => 'Текстовый'],
							"clientOptions" => 
								[
									"includeSelectAllOption" => true,
									'numberDisplayed' => 2
								],
						]); ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
						<?= $form->field($model, 'status')->widget(MultiSelect::className(),[
							'data' => ['1' => 'показать', '2' => 'скрыть'],
							"clientOptions" => 
								[
									"includeSelectAllOption" => true,
									'numberDisplayed' => 2
								],
						]); ?>
                    </div>
                </div>

                <?php //echo $form->field($model, 'sub_category')->textInput(['maxlength' => true]) ?>
                

                <?= $form->field($model, 'short_description')->widget(CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                    ]
                ]); ?>
                <?= $form->field($model, 'description')->widget(CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                    ]
                ]); ?>


                <?php // echo $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

                <?php // $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                <?= $form->field($model, 'meta_title')->textarea(['rows' => 1]) ?>

                <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 2]) ?>

                <?= $form->field($model, 'meta_description')->textarea(['rows' => 3]) ?>
            </div>
        </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
