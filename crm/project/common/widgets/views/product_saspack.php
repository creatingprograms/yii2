<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
?>

<section class="section section_default">
    <div class="in-desc">
        <div class="wrapper wrapper_content">
            <div class="row ">
                <div class="col col--lg-6">
                    <div class="in-desc__left">
                        <h2 class="h2 h2_light"><?=$info->title?></h2>
                        <div class="paragraph paragraph_default">
                            <?=$info->description?>

                        </div>
                    </div>
                </div>
                <div class="col col--lg-6">
                    <div class="in-desc__hand">
                        <img src="/uploads/images/<?=$info->imageFile?>" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>