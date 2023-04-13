<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\UploadForm;
use kartik\file\FileInput;
use dosamigos\multiselect\MultiSelect;
use mihaildev\ckeditor\CKEditor;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use backend\modules\catalog\models\StoreAttribute;
use backend\modules\catalog\models\StoreProduct;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Описание страницы</a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#attributes" role="tab" aria-controls="profile" aria-selected="false">Атрибуты</a>
        </li>-->
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Сео настройки</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row margin-bottom-11">
                <div class="col-md-5 col-sm-5 col-lg-offset-1">
                    <div class="service-block-blue">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5	">
                    <div class="service-block-blue">
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <div class="row margin-bottom-11">
                <div class="col-md-2 col-sm-2 col-lg-offset-1">
                    <?= $form->field($model, 'discount_price')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2 col-sm-2">
                    <div class="service-block-blue">
                        <?= $form->field($model, 'status')->widget(MultiSelect::className(),[
                            'data' => ['1' => 'видна', '2' => 'скрыта'],
                            "clientOptions" => 
                                [
                                    "includeSelectAllOption" => true,
                                    'numberDisplayed' => 2
                                ],
                        ]); ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
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
            <!--добавление изображений в товар-->
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
                                                        <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>
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
                    <?php // $form->field($model, 'parent_id')->textInput() ?>
                    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
                </div>
            </div>  
        </div>
         <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
             <div class="row margin-bottom-11">
                 <div class="col-md-10 col-sm-10 col-lg-offset-1">
                     <?= $form->field($model, 'meta_title')->textarea(['rows' => 1]) ?>
                     <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 2]) ?>
                     <?= $form->field($model, 'meta_description')->textarea(['rows' => 3]) ?>
                 </div>
             </div>
         </div>
    </div>
    <div class="row margin-bottom-11">
        <div class="col-md-10 col-sm-10 col-lg-offset-1">
            <div class="form-group">
				<?php if(!empty($model->id)){
				?>
					<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
				<?php }else{ ?>
					<?= Html::submitButton('Продолжить', ['class' => 'btn btn-success']) ?>
				<?php } ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
