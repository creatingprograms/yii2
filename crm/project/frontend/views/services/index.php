<?php
use yii\helpers\Url;
use yii\helpers\Html;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreAttribute;
use backend\models\Menuitem;
use backend\models\Menu;
use common\widgets\ServicesWidget;
use common\widgets\RentWidget;
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

<?php if(empty($model)){ ?>
	<div class="conteiner">
		<p>На данный момент в этой категории услуг нет.</p>
	</div>
<?php }else{ ?>
        <div class="list-view">
            <div class="conteiner">
		<h3>Предоставляем услуги</h3>
                <?php 
                foreach($model as $m){ ?>
                <a title="<?=$m->title?>" href="/services/<?=$m->slug?>">
                    <div class="elBit">
                        <div class="elImg">		
                            <div class="boxNewSale">
                            </div>
                            <img src="/uploads/images/<?=$m->imageFile?>" alt="<?=$m->title?>">
                        </div>
                        <h3><?=$m->title?></h3>
                    </div>
                </a>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </div>
				<?php } ?>

<?=ServicesWidget::widget(); ?>
<?=RentWidget::widget(); ?>
