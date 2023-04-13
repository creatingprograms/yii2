<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
?>
<main class="main">
    <div class="single">
        <div class="wrapper wrapper_large">
            <h1 class="h2 single__title">
                Услуги
            </h1>
        </div>
        <?php foreach ($slides as $slide){ ?>
            <!--<div>
                <div class="collection__item" style="background-image: url('/uploads/images/<?$slide->imageFile?>')">
                    <div class="collection__mobile">
                        <img src="uploads/images/<?$slide->allFile?>" alt="">
                    </div>
                    <div class="collection__content">
                        <span class="collection__sub">
                            Коллекция
                        </span>
                        <span class="collection__title">
                            <?$slide->title?>
                        </span>
                        <div class="collection__desc">
                            <?$slide->anons?>
                        </div>

                        <a href="/collection/<?$slide->slug?>" class="iconed iconed_center more-link">
                            <span class="circle-middle_wrapper iconed__ico iconed__ico_r-default">
                                <span class="circle  circle_middle circle_blue">
                                    <svg class="arrow-ico circle_arrow">
                                        <use xlink:href="images/icons.svg#arrow-icon">
                                        </use>
                                    </svg>
                                </span>
                            </span>
                            <span class="more-link__title title title_semy title_default title_blue">
                                Смотреть коллекцию
                            </span>
                        </a>
                    </div>
                </div>
            </div>-->
        <?php } ?>
    </div>
    
    
</main>
