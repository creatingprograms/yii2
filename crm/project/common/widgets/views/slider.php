<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\widgets\AdvantageWidget;

$this->title = 'Слайдер';
?>

<?php 
    if(count($slides) != 1){ ?>
<div id="mainShow">
    <ul id="showList">
    <?php
    foreach ($slides as $slide){ ?>
        <li>
            <div class="slideBit">
                <img src="/uploads/images/<?=$slide->imageFile?>" alt="<?=$slide->title?>">
                <div class="txtBox">
                    <div class="conteiner">	
                        <h1 class="slideTitle"><?=$slide->title?></h1>				
                        <div class="slideText"><?=$slide->description?></div>
                        <img src="/uploads/images/<?=$slide->allFile?>" class="backTop" alt="">
                        
                        <?= AdvantageWidget::widget() ?>
                    </div>
                </div>		
            </div>		
        </li>
        <?php } ?>
    </ul>
    <div class="clear"></div>
</div>
<?php }else{ ?>
<div id="mainShow">
    <div class="slideBit" style="background: url(/uploads/images/<?=$slides->imageFile?>)">
        <div class="conteiner">	
            <h1 class="slideTitle"><?=$slides->title?></h1>				
            <div class="slideText"><?=$slides->description?></div>
            <span class="dop_infa"><img src="/uploads/images/<?=$slides->allFile?>" class="backTop" alt="">
                <span><b>1000+</b>
                    <p>Выполненных пректов</p></span>
            </span>
            
            <a href="<?=$slides->href?>">узнать подробнее</a>
        </div>	
    </div>

</div>
<?php } ?>