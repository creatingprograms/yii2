<?php
use yii\helpers\Url;
use yii\helpers\Html;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreAttribute;
use backend\models\Menuitem;
use backend\models\Menu;
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
<div class="conteiner">
	<h1 class="titleBig"><?=$model->title;?></h1>
</div>
<div class="conteiner">
	<?php foreach ($records as $k){
		$collection = StoreProducer::find()->where(['id'=>$k->producer_id])->one();
		$products = StoreAttributeValue::find()->where(['product_id'=>$k->id])->all();
		$product = StoreProduct::find()->where(['id'=>$k->id])->one();
		$cat = StoreCategory::find()->where(['id'=>$product->category_id])->one();
		//foreach ($products as $m){
		//$product=StoreProduct::find()->where(['id'=>$m->product_id])->one();
		//!empty($product)? $one_attr = StoreAttribute::find()->where(['id'=>$m->attribute_id])->one(): $one_attr= '';
	?>
	
	<a title="<?=$k->title?>" href="/store/<?=$k->slug?>">
	<div class="elBit">
	<div class="elImg">		
		<div class="boxNewSale">
						</div>			
			
		<img src="/uploads/images/<?=$k->imageFile?>" alt="<?=$k->title?>">
			
	</div>
	<h3><?=$k->title?>, <?=$k->sku?>
	<br><br>Цена от: <?=$k->discount_price?>руб.</h3>
</a>
	<?php //}
	} ?>
	</div>
	<div class="clear"></div>
	<?php } ?>
</div>