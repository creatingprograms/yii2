<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\multiselect\MultiSelect;
use backend\models\UploadForm;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">
    <?php
    $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]);
    ?>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Основные настройки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Изображения и доп. настройки</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <?php foreach ($settings as $index => $setting) { ?>
                    <?php
                        if($setting->param_name == 'renderIndex') {
                            echo $form->field($setting, "[$index]param_value")->label(Yii::t('app', $setting->param_name))->widget(MultiSelect::className(),[
                                'data' => ['1' => 'Нет',
                                    '2' => 'Да'],
                                "clientOptions" =>
                                    [
                                        "includeSelectAllOption" => true,
                                        'numberDisplayed' => 2
                                    ],
                            ]);
                        }elseif($setting->param_name == 'currency' or $setting->param_name == 'productCount' or $setting->param_name == 'productSort' or $setting->param_name == 'routeSort'){
                            echo $form->field($setting, "[$index]param_value")->label(Yii::t('app', $setting->param_name));
                    }} ?>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <?php 
                foreach ($settings as $index => $setting) {
                    if($setting->param_name == 'storeTitle' or $setting->param_name == 'storeDescription' or $setting->param_name == 'siteKeyWords' or $setting->param_name == 'defaultImage'){
                        if($setting->param_name == 'defaultImage') {

                            echo $form->field($model, 'upload_image')->widget(FileInput::className(), [
                                'options' => ['accept'=>'image/*'],
                                'pluginOptions' => [
                                    'initialPreview'=> !empty($model->param_value)? Html::img("/uploads/images/default/" . $model->param_value) : '',
                                    'overwriteInitial'=>true
                                ],
                            ]);
                        }else{

                            echo $form->field($setting, "[$index]param_value")->label(Yii::t('app', $setting->param_name));
                        }
                } ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
