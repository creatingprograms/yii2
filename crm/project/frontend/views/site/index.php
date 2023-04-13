<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\SliderWidget;
use common\widgets\ProductionWidget;
use common\widgets\AdvantageWidget;
use common\widgets\ProductSaspackWidget;
use common\widgets\CooperationWidget;
use backend\models\Menuitem;
use backend\models\Menu;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreAttribute;
use backend\models\Contacts;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

if(!empty($settings)){
    foreach ($settings as $m){
        $m->param_name == 'logo'? $logo = $m->param_value: $logo = '';
        $m->param_name == 'siteName'? $siteName = $m->param_value: $siteName = '';
        $m->param_name == 'siteDescription'? $siteDescription = $m->param_value: $siteDescription = '';
        $m->param_name == 'siteKeyWords'? $siteKeyWords = $m->param_value: $siteKeyWords = '';
        $m->param_name == 'email'? $email = $m->param_value: $email = '';
        $m->param_name == 'indexation'? $indexation = $m->param_value: $indexation = '';
    }
}
$this->title = $siteName;
?>



<?= SliderWidget::widget() ?>

<div class="wrapper wrapper_large">

    <div class="short-nav__wrapper custom-scroll custom-scroll__transparent">
        <div class="short-nav">
            <?php 
            $menu = Menu::find()->where(['code'=>'top-menu'])->where(['status'=>'1'])->one();
            $menuItem = Menuitem::find()->where(['href'=>'/store'])->one();
            $childrens = Menuitem::find()->andWhere(['menu_id'=>$menu->id])->andWhere(['parent_id'=>$menuItem->id])->orderBy('sort')->all();
            foreach ($childrens as $children){ ?>
                <a href="<?=$children->href?>" class="short-nav__item">
                    <span class="short-nav__img">
                        <img src="/uploads/images/<?=$children->imageFile?>" alt="">
                    </span>
                    <span class="short-nav__title">
                        <?=$children->title?>
                    </span>
                </a>
            <?php } ?>
            <a href="/store" class="short-nav__item">
                <span class="short-nav__img">
                    <span class="circle_big__wrapper">
                        <span class="circle circle_big circle_blue">
                            <svg class="arrow-ico circle_arrow">
                                <use xlink:href="images/icons.svg#arrow-icon">
                                </use>
                            </svg>
                        </span>
                    </span>
                </span>
                <span class="short-nav__title">
                    Весь каталог
                </span>
            </a>
        </div>
    </div>
    
    <?= ProductionWidget::widget() ?>
</div>
    
<div class="wrapper wrapper_large">
	<section class="section section_medium">
		<h2 class="h2 h2_light in-second__title">Готовая продукция</h2>
		<div class="masonry-grid">
		
			<?php
			foreach ($product as $m){
				$product = StoreProduct::find()->where(['id'=>$m->product_id])->one();
				!empty($product)? $collection = StoreProducer::find()->where(['id'=>$product->producer_id])->one(): $collection= '';
				!empty($product)? $one_attr = StoreAttribute::find()->where(['id'=>$m->attribute_id])->one(): $one_attr= '';
				?>
						<div class="grid-item">
							<div class="product-masonry">
								<div class="product">
									<a href="/store/<?=$m->slug?>" class="product__img">
										<?php if(!empty($m->option_value)){ ?>
											<span class="stickers">
												<span class="sticker__wrapper">
													<i class="sticker sticker_red">
														-<?=$m->option_value?>%
													</i>
												</span>

											</span>
										<?php } ?>
										<img src="/uploads/images/<?=$m->string_value?>" />
									</a>
									<div class="product__detail">
										<?= !empty($collection)? Html::a($collection->title, Url::to(['collection/view', 'slug'=>$collection->slug]),['class'=> 'product__brand']): ''   ?>
										<?= !empty($product)? Html::a($product->title.', '.mb_strtolower($one_attr->title), Url::to(['store/view', 'slug'=>$product->slug]),['class'=> 'product__title']): ''   ?>
										<span class="product__price">
											<?php if(!empty($m->option_value)){
												$price = $m->number_value-$m->number_value * ($m->option_value/100);
											?>
											<?=preg_replace( '#\..*#', '', $price )?> <sup class="product__sup"><?= substr($price, -2)?></sup> руб.
											<?php }else{ ?>
											<?=preg_replace( '#\..*#', '', $m->number_value )?> <sup class="product__sup"><?= substr($m->number_value, -2)?></sup> руб.
											<?php } ?>
										</span>
									</div>
								</div>
							</div>
						</div>
		<?php } ?>
			
		</div>


		<div class="btn-wrapper btn-wrapper_centered">
			<div class="circle-macro__wrapper">
				<a href="/store" class="circle circle_macro circle_blue">
					<span class="circle__text">
						Перейти<br> в каталог
					</span>
				</a>
			</div>
		</div>
	</section>
<?= AdvantageWidget::widget() ?>
<?= ProductSaspackWidget::widget() ?>
</div>
<?php // CooperationWidget::widget() ?>
    <section class="section section_gray">
    <div class="cooperation">
        <div class="row">
            <div class="col col--lg-6">
                <div class="cooperation__desc">
                    <h2 class="h2 h2_light cooperation__title"><?=$info->title?></h2>
                    <div class="paragraph paragraph_default">
                        <?=$info->description?>
                    </div>
                    <div class="man-tile">
                        <div class="man-tile__content">
                            <div class="man-tile__img man-tile__img_offset">
                                <img class="man-tile__pic" src="images/avatar.jpg" alt="">
                                <i class="status status_green man-tile__status"></i>
                            </div>
                            <div class="man-tile__info">
                                <a href="<?=Contacts::find()->where(['param_name'=>'phone'])->one()->param_link?>" class="phone man-tile__phone">
                                    <?=Contacts::find()->where(['param_name'=>'phone'])->one()->param_value?>
                                </a>
                                <span class="man-tile__title">
                                    Александр Кузнецов
                                </span>
                            </div>
                        </div>
                        <div class="soc man-tile__soc">
                            <a href="<?=Contacts::find()->where(['param_name'=>'socialNetworkWh'])->one()->param_link?>" class="soc__item">
                                <img class="man-tile__ico" src="/uploads/images/default/<?=Contacts::find()->where(['param_name'=>'socialNetworkWh'])->one()->param_icon?>" alt="">
                            </a>
                            <a href="<?=Contacts::find()->where(['param_name'=>'socialNetworkTg'])->one()->param_link?>" class="soc__item">
                                <img class="man-tile__ico" src="/uploads/images/default/<?=Contacts::find()->where(['param_name'=>'socialNetworkTg'])->one()->param_icon?>" alt="">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col col--lg-4 col--lg-offset-2">
			<?php Pjax::begin(['id' => 'my-pjax', 'enablePushState' => false, 'formSelector' => '#contact-form']); ?>
			<?php $form = ActiveForm::begin([ 'id' => 'contact-form', 'action' => '/', 'options' => ['data-pjax' => true], 'class'=>'cooperation-form form',
//                    'enableClientValidation'=> false,
                    ]); ?>
                    <div class="form__item">
                        <h4 class="form__title">
                            Напишите нам
                        </h4>
                    </div>
						<?= $form->field($model1, 'name')->textInput(['class' => 'form-check-input input input_default', 'placeholder' => "Как вас зовут?"])->label('') ?>
						<?= $form->field($model1, 'phone')->textInput(['class' => 'form-check-input input input_default phone-mask', 'placeholder' => 'Телефон?', 'type'=>'tel'])->label('') ?>
						<?= $form->field($model1, 'body')->textarea(['class' => 'form-check-input textarea textarea_default', 'placeholder' => 'Ваше сообщение', 'rows' => 6])->label('') ?>
                    
					
                    <div class="form__item form__item_t-offset">
                        <button class="iconed iconed_center more-link more-link_submit" type="submit" name="contact-button">

                            <span class="circle-middle_wrapper iconed__ico iconed__ico_r-default">
                                <span class="circle  circle_middle circle_blue">
                                    <svg class="arrow-ico circle_arrow">
                                        <use xlink:href="images/icons.svg#arrow-icon">
                                        </use>
                                    </svg>
                                </span>
                            </span>
                            <span class="more-link__title title title_semy title_default title_blue">
                                Отправить
                            </span>

                        </button>
                    </div>
            <?php ActiveForm::end(); ?>
                
			<?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</section>
</div>
