<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
?>


<div id="advantages" data-paroller-factor="0.5" data-paroller-type="background" data-paroller-direction="vertical">
    <div class="conteiner">
        <h2><?=$info->title?></h2>
        <?php 
        foreach ($slides as $slide){ ?>
        <div class="advBit" id="bx_651765591_20">
			<div class="advImg">
				<img src="/uploads/images/<?=$slide->imageFile?>">
			</div>
			<div class="adevTit"><?=$slide->title?></div>
			<div class="popup"><?=$slide->description?></div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
</div>