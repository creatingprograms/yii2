<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\modules\catalog\models\StoreProducer;
?>

<div class="buyout" id="buyout">
    <div class="conteiner">
        <?php if ((Yii::$app->controller->id == 'site') and (Yii::$app->controller->action->id == 'index')) { ?>
        <h2><?=$info->title?></h2>
        <?php }else{ ?>
        <h2><?=$info->description?></h2>
        <?php }
        foreach ($slides as $slide){ ?>
        <div class="advBit" id="bx_651765591_20">
        <div class="advImg">
        <?php if ((Yii::$app->controller->id == 'site') and (Yii::$app->controller->action->id == 'index')) { ?>
                <img src="/uploads/images/<?=$slide->imageFile?>">
        <?php }else{ ?>
                <img src="/uploads/images/<?=$info->imageFile?>">
        <?php } ?>
        </div>
        <div class="adevTit">
                <?=$slide->title?></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
</div>