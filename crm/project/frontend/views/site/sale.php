<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\AdvantageWidget;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreAttribute;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreCategory;

?>
<div class="conteiner">
	<h1 class="titleBig"><?=$model->title;?></h1>
</div>
<div class="conteiner">
	<?php foreach ($records as $k){
		//$collection = StoreProducer::find()->where(['id'=>$k->producer_id])->one();
		//$products = StoreAttributeValue::find()->where(['product_id'=>$k->id])->all();
		//$product = StoreProduct::find()->where(['id'=>$k->id])->one();
		//$cat = StoreCategory::find()->where(['id'=>$k->category_id])->one();
		//foreach ($products as $m){
		//$product=StoreProduct::find()->where(['id'=>$m->product_id])->one();
		//!empty($product)? $one_attr = StoreAttribute::find()->where(['id'=>$m->attribute_id])->one(): $one_attr= '';
	?>
	
	<a title="<?=$k->title?>" href="/store/<?=$k->slug?>">
		<div class="elBit">
			<div class="elImg">		
				<div class="boxNewSale"></div>
				<img src="/uploads/images/<?=$k->imageFile?>" alt="<?=$k->title?>">
			</div>
			<h3><?=$k->title?>, <?=$k->sku?>
			<?php if(!empty($k->discount_price)) { ?><br><br>Цена от: <?=$k->discount_price?>руб.</h3><?php } ?>
		</div>
	</a>
			<?php //}
			} ?>
	<div class="clear"></div>
</div>