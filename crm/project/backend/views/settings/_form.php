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
	<?php $form = ActiveForm::begin([
		'options' => ['enctype'=>'multipart/form-data'],
		'fieldConfig' => [
			'template' => "{input}{label}{error}",
				'options' => [
					'class' => 'input form-group'
				]
	],
	]); ?>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Основные настройки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Языковые настройки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Изображения и доп. настройки</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <?php foreach ($settings as $index => $setting) { ?>
                    <?php
                        if($setting->param_name == 'logo') {

                            echo $form->field($model, 'upload_image')->widget(FileInput::className(), [
                                'options' => ['accept'=>'image/*'],
                                'pluginOptions' => [
                                    'initialPreview'=> !empty($model->param_value)? Html::img("/uploads/images/default/" . $model->param_value) : '',
                                    'overwriteInitial'=>true
                                ],
                            ]);
                        }elseif($setting->param_name == 'siteName' or $setting->param_name == 'siteDescription' or $setting->param_name == 'siteKeyWords' or $setting->param_name == 'email'){ ?>
						
						<?php if(!isset($setting->param_name) || $setting->param_name != null){
							echo $form->field($setting, "[$index]param_value")->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label']);
						}else{
							echo $form->field($setting, "[$index]param_value")->textInput(['maxlength' => true, 'class' => 'input__elem'])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label']);
						}
                    }} ?>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php 
                foreach ($settings as $index => $setting) { ?>
                        <?php if($setting->param_name == 'defaultLanguage' or $setting->param_name == 'availableLanguages'){
							if(isset($setting->param_name)){
								echo $form->field($setting, "[$index]param_value")->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label']);
							}else{
								echo $form->field($setting, "[$index]param_value")->textInput(['maxlength' => true, 'class' => 'input__elem'])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label']);
							}
                }}?>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <?php 
                foreach ($settings as $index => $setting) {
                    if($setting->param_name == 'allowedExtensions' or $setting->param_name == 'defaultImage' or $setting->param_name == 'indexation' or $setting->param_name == 'typeSite'){
                        if($setting->param_name == 'indexation'){
							if(isset($setting->param_name)){
								echo $form->field($setting, "[$index]param_value", ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label'])->dropDownList(['1' => 'Разрешить', '2' => 'Запретить']);
							}else{
								echo $form->field($setting, "[$index]param_value", ['inputOptions'=> ['class' => 'select-styled input__elem']])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label'])->dropDownList(['1' => 'Разрешить', '2' => 'Запретить']);							
							}
                        } elseif($setting->param_name == 'typeSite') {
							echo $form->field($setting, 'type', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label'])->dropDownList(['1' => 'CRM', '2' => 'SUPER-CRM']);
                        }elseif($setting->param_name == 'defaultImage') {

                            echo $form->field($model1, 'upload_image1')->widget(FileInput::className(), [
                                'options' => ['accept'=>'image/*'],
                                'pluginOptions' => [
                                    'initialPreview'=> !empty($model1->param_value)? Html::img("/uploads/images/default/" . $model1->param_value) : '',
                                    'overwriteInitial'=>true
                                ],
                            ]);
                        }else{
							if(isset($setting->param_name)){
								echo $form->field($setting, "[$index]param_value")->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label']);
							}else{
								echo $form->field($setting, "[$index]param_value")->textInput(['maxlength' => true, 'class' => 'input__elem'])->label(Yii::t('app', $setting->param_name), ['class' => 'input__elem-label']);
							}
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
