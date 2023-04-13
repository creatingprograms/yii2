<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\StoreProduct */

?>




    <a title="<?=$model->title?>" href="/store/<?=$model->slug?>">
            <div class="elBit">
                    <div class="elImg">		
                            <div class="boxNewSale">
                                                            </div>			

                            <img src="/uploads/images/<?=$model->imageFile?>" alt="<?=$model->title?>">

                    </div>
                <h3><?=$model->title?></h3></br>
                    <?php if(!empty($model->discount_price)) { ?><p>Цена от: <b><?=$model->discount_price?>руб.</b></p><?php } ?>
                    <?php if(!empty($model->sku)) { ?><p>Артикул: <b><?=$model->sku?></b></p><?php } ?>
                    <a href="/store/<?=$model->slug?>" class="btn">Узнать цену</a>
            </div>
    </a>
