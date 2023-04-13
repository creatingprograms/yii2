<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use backend\modules\catalog\models\StoreAttributeValue;
?>
<div class="conteiner">
    <?php 
    foreach($filters as $model){ ?>
    <a title="<?=$model->title?>" href="/store/<?=$model->slug?>">
        <div class="elBit">
            <div class="elImg">		
                <div class="boxNewSale">
                </div>
                <img src="/uploads/images/<?=$model->imageFile?>" alt="<?=$model->title?>">
            </div>
            <h3><?=$model->title?></h3></br>
            <?php $attrs = StoreAttributeValue::find()->where(['product_id'=>$model->id])->all();
            foreach ($attrs as $attr){ ?>
                <p><?=$attr->text_value?>: <b><?=$attr->string_value?></b></p>
            <?php } if(empty($model->discount_price)){ ?>
            <a href="/store/<?=$model->slug?>" class="btn">Узнать цену</a>
            <?php }else{ ?>
            <a href="/store/<?=$model->slug?>" class="btn">Цена: <b><?=$model->discount_price?></b></a>
            <?php } ?>
        </div>
    </a>
    <?php } ?>