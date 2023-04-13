<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use backend\models\Staticpage;



$model = Staticpage::find()->where(['slug'=>'error'])->one();
?>

    <main class="main">
        <div class="p-404__content container">
            <div class="p-404__item">
				<div class="row margin-bottom-11">
					<div class="col-md-6 col-sm-6">
						<img src="/uploads/images/<?=$model->imageFile?>" alt="">
					</div>
					<div class="col-md-6 col-sm-6">
						<h2 class="h2 h2_light in-second__title p-404__title"><?php//$model->title?></h2>
						<a href="/" class="iconed iconed_center more-link">
							<span class="circle-middle_wrapper iconed__ico iconed__ico_r-default">
								<span class="circle  circle_middle circle_blue">
									<svg class="arrow-ico circle_arrow">
										<use xlink:href="images/icons.svg#arrow-icon">
										</use>
									</svg>
								</span>
							</span>
							<span class="more-link__title title title_semy title_default title_blue">
								На главную
							</span>
						</a>
					</div>
				</div>
            </div>
        </div>
    </main>
