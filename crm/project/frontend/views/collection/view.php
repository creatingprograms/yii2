<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\widgets\BrandingWidget;
use common\widgets\AdvantageWidget;
use common\widgets\ProductSaspackWidget;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreAttribute;
/* @var $this yii\web\View */
?>
<main class="main">
    <div class="single">
        <div class="wrapper wrapper_large">
            <h1 class="h2 single__title">
                Коллекция <?=$model->title?>
            </h1>
        </div>
        <?php if(!empty($records)){ ?>
        <div class="magic">

            <div class="s-collection ">
                <div class="wrapper wrapper_small">
                    <div class="row row--lg-end">
                        <?php if(!empty($records[0])){ ?>
                            <div class="col col--md-4">
                                <div class="s-collection__desc s-collection__desc_abs s-desc__left s-collection__desc_top">
                                    <p>
                                        <?=$records[0]->anons?>
                                    </p>
                                </div>
                                <div class="s-collection__desc s-collection__desc_abs s-desc__b-left s-collection__desc_top">
                                    <p>
                                        <?=$records[0]->description?>
                                    </p>
                                </div>
                                <div class="s-collection__item op-item">
                                    <div class="s-collection__img">
                                        <img src="/uploads/images/<?=$records[0]->imageFile?>" alt="">
                                    </div>
                                    <span class="s-collection__name match-height"><?=$records[0]->title?></span>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(!empty($records[1])){ ?>
                            <div class="col col--md-4">
                                <div class="s-collection__item">
                                    <div class="s-collection__img">
                                        <img src="/uploads/images/<?=$records[1]->imageFile?>" alt="">
                                    </div>
                                    <span class="s-collection__name match-height"><?=$records[1]->title?></span>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if(!empty($records[1])){ ?>
                            <div class="col col--md-4">
                                <div class="s-collection__desc s-desc__right s-collection__desc_abs">
                                    <p>
                                        <?=$records[1]->anons?>
                                    </p>
                                </div>
                                <div class="s-collection__desc s-collection__desc_abs s-desc__b-right s-collection__desc_top">
                                    <p>
                                        <?=$records[1]->description?>
                                    </p>
                                </div>
                                <?php if(!empty($records[2])){ ?>
                                    <div class="s-collection__item op-item">
                                        <div class="s-collection__img">
                                            <img src="/uploads/images/<?=$records[2]->imageFile?>" alt="">
                                        </div>
                                        <span class="s-collection__name match-height"><?=$records[2]->title?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="btn-wrapper btn-wrapper_center">
                        <a href="/contact" class="iconed iconed_center more-link">
                            <span class="circle-middle_wrapper iconed__ico iconed__ico_r-default">
                                <span class="circle  circle_middle circle_blue">
                                    <svg class="arrow-ico circle_arrow">
                                        <use xlink:href="/images/icons.svg#arrow-icon">
                                        </use>
                                    </svg>
                                </span>
                            </span>
                            <span class="more-link__title title title_semy title_default title_blue">
                                Запросить цену коллекции
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php if(!empty($model->description)){ ?>
        <div class="wrapper wrapper_small">
            <div class="in-second__desc collection-l paragraph paragraph_default">
                <p>
                    <?=$model->description?>
                </p>
            </div>
        </div>
        <?php } ?>
        <?php if(!empty($model->allFile)){ ?>
        <div class="section section_medium">
            <div class="baner baner_imagered">
                <img class="baner__img" src="/uploads/images/<?=$model->allFile?>" alt="">
            </div>

        </div>
        <?php } ?>
    </div>

	<div class="section section_medium">
		<div class="wrapper wrapper_large">
			<div class="relative-products">
				<div class="masonry-grid">
				<?php foreach($products as $product){
					$p = StoreProduct::find()->where(['id'=>$product->product_id])->one();
					$c = StoreProducer::find()->where(['id'=>$p->producer_id])->one();
					!empty($product)? $one_attr = StoreAttribute::find()->where(['id'=>$product->attribute_id])->one(): $one_attr= '';
				?>
				
					<div class="grid-item">
						<div class="product-masonry">
							<div class="product">
								<a href="/store/<?=$product->slug?>" class="product__img">
									<?php if(!empty($product->option_value)){ ?>
									<span class="stickers">
										<span class="sticker__wrapper">
											<i class="sticker sticker_red">
												-<?=$product->option_value?>%
											</i>
										</span>

									</span>
									<?php } ?>
									<img src="/uploads/images/<?=$product->string_value?> " alt="">
								</a>
								<div class="product__detail">
									<a href="/collection/<?=$c->slug?>" class="product__brand">
										<?=$c->title?>
									</a>
									<a href="/store/<?=$product->slug?>" class="product__title">
										<?=$p->title?>, 
										<?=mb_strtolower($one_attr->title)?>
									</a>
									<span class="product__price">
										<?=preg_replace( '#\..*#', '', $product->number_value )?> <sup class="product__sup"><?= substr($product->number_value, -2)?> </sup>
										руб.
									</span>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	
    <?= BrandingWidget::widget() ?>
    <?= AdvantageWidget::widget() ?>
    <?= ProductSaspackWidget::widget() ?>
</main>