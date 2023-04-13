<?php
use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Menuitem;
use backend\models\Menu;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreAttribute;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreCategory;
use common\widgets\ServicesWidget;
use common\widgets\RentWidget;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
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

$this->title = $titl;
$this->params['breadcrumbs'][] = '/ '. $model->title;
?>
<?php
Pjax::begin(); ?>
<?php if(!empty($cats)){ ?>

<div class="conteiner">
    
    	
    <div id="sectBox">
            <?php foreach ($model as $cat){ ?>
            <div class="sectBit">
                    <div class="sectImg">
                            <a href="/services/<?=$cat->slug?>">

                                    <img src="/uploads/images/<?=$cat->imageFile?>" alt="<?=$cat->title?>">

                            </a>	
                    </div>
                    <h3><a href="/services/<?=$cat->slug?>"><?=$cat->title?></a></h3>
            </div>
            <?php } ?>
    </div>

</div>
<?php if(!empty($model->short_description)){ ?>
		<div id="decription">
			<div class="conteiner">
				<?=$model->short_description?><div class="clear"></div>
			</div>
		</div>
		<?php }else{ ?>
<div class="clear"></div>
				<?php } ?>	
<?php }elseif(empty($records)){ ?>
	<div class="conteiner">
		<p>На данный момент в этой категории услуг нет.</p>
	</div>
<?php }else{ ?>
        <div class="list-view">
            <div class="conteiner">
		<h3>Предоставляем услуги</h3>
		<p><?=$model->title?></p>
                <?php 
                foreach($records as $model){ ?>
                <a title="<?=$model->title?>" href="/services/<?=$model->slug?>">
                    <div class="elBit">
                        <div class="elImg">		
                            <div class="boxNewSale">
                            </div>
                            <img src="/uploads/images/<?=$model->imageFile?>" alt="<?=$model->title?>">
                        </div>
                        <h3><?=$model->title?></h3>
                    </div>
                </a>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </div>
				<?php } ?>

<?php Pjax::end(); ?>
<?=ServicesWidget::widget(); ?>
<?=RentWidget::widget(); ?>
