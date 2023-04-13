<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
?>
<div class="production">
    <div class="container">
        <h3><?=$info->title?></h3>
        <ul id="product" class="cs-hidden">
            <?php
            foreach ($slides as $slide){ ?>
                <li data-thumb="/uploads/images/<?=$slide->imageFile?>" data-src="/uploads/images/<?=$slide->imageFile?>">
                  <div class="slideBit">
                      <img src="/uploads/images/<?=$slide->imageFile?>" alt="<?=$slide->title?>">		
                  </div>
                </li>
            <?php } ?>
        </ul>
    </div>

</div>