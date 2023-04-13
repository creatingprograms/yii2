<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
?>
<?php if ($slides != []){ ?>
<div class="review">
    <div class="conteiner">
        <h2><?=$info->title?></h2>
        <ul id="reviewList">
            <?php
            foreach ($slides as $slide){ ?>
                <li>
                    <div class="slideBit">
                        <img src="/uploads/images/<?=$slide->imageFile?>" alt="<?=$slide->title?>">
                        <div class="txtBox">
                            <div class="conteiner">				
                                <div class="slideText"><?=$slide->description?></div>
                                <img src="/uploads/images/<?=$slide->allFile?>" alt="">
                            </div>
                        </div>		
                    </div>		
                </li>
            <?php } ?>
        </ul>
        <span class="kav"></span>
    </div>
</div>
<?php } ?>