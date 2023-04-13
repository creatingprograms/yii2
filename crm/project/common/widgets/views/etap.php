<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\modules\catalog\models\StoreProducer;
?>

<div class="etaps">
    <div class="conteiner">
        <h2><?=$info->title?></h2>
        <?php 
        foreach ($slides as $slide){ ?>
        <div class="advBit" id="bx_651765591_20">
        <div class="advImg">
                <img src="/uploads/images/<?=$slide->imageFile?>">
        </div>
        <div class="adevTit">
            <b><?=$slide->title?></b>
            <p><?=$slide->description?></p></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
</div>