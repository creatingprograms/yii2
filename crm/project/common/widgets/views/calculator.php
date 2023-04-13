<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Constructform;
use yii\widgets\Pjax;
use yii\web\UploadedFile;
use kartik\file\FileInput;
use backend\models\Constructor;

?>
<div class="calculation" id="calculation">
    <div class="title"><b>Аренда</b> вилочных погрузчиков</div>
    <div class="conteiner calc">
        
        <div class="left">
            <?php 
            $k=1;
            foreach($calculatios as $calc) { ?>
            <div class="group">
                <span><?=$calc->title?>
                <?php $params = Constructor::find()->where(['parent_id'=>$calc->id])->all();
                    $l=1; 
                    foreach($params as $param){
                        if($calc->title=='Срок аренды'){
                        ?>
                        <span class="asrok">от 1 до <?=$param->price?> дней</span>
                    <?php }} ?></span>
                <div class="const_el">
                    <?php foreach($params as $param){
                        if($calc->title=='Срок аренды'){
                ?>
                        <input type="range" min="1" name="type<?=$k?>" max="<?=$param->price?>" step="1" value="1" class="range_form"> 
                    <?php }else{ ?>
                        <span class="rad_const">
                            <label>
                                <input <?=$l==1?'checked':''?> rel="<?=$param->title?>" name="type<?=$k?>" type="radio" value="<?=$param->price?>" class="<?=$calc->title=='Количество смен'? 'smeni': ''?>"><?=$param->title?>
                                <span></span>
                            </label>
                        </span>
                
                    <?php }

                    $l++;
                    } ?>
            
                </div>
            </div>
            <?php if($k != 5){ ?><div class="line">
            </div>
            <?php } $k++; } ?>
            
            
        </div>
        <div class="form">
            <p>Стоимость аренды в день составит:</p>
            <b class="summ">220 руб</b>
            <?php Pjax::begin(['id' => 'my-pjax', 'enablePushState' => false, 'formSelector' => '#calc-form']); ?>
            <?php $form = ActiveForm::begin([  'method'=>'post', 'id' => 'calc-form', 'action' => '/svayz.php', 'options' => ['data-pjax' => true], 'class'=>'calc-form form',
            //                    'enableClientValidation'=> false,
                ]); ?>
            <div class="row row_t-reverce">
                <div class="col col--lg-6">
                        <div class="constructform-form">
                            <?= $form->field($model, 'nabor1')->hiddenInput(['class' => 'form-check-input input input_default', 'pole' => "1", 'name'=>'nabor1'])->label('') ?></div>
                    <div class="form__item">
                        <?= $form->field($model, 'name')->textInput(['class' => 'form-check-input input input_default', 'placeholder' => "Ваше имя", 'name'=>'names'])->label('') ?>
                        </div>
                    <div class="form__item">
                        <?= $form->field($model, 'phone')->textInput(['class' => 'form-check-input input input_default phone-mask', 'placeholder' => 'Номер телефона', 'name'=>'phone'])->label('') ?>
                    </div>
                    <div class="form__item">
                        <?= Html::submitButton('Заказать', ['class' => 'popup_btn']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <?php Pjax::end(); ?>
            <p class="kolontikul">* Cтоимость зависит от года выпуска погрузчика и его комплектации</p>
        </div>
    </div>
    <img src="/images/back_3.png" class="calculation_bg">
</div>