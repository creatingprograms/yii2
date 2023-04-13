<?php
use yii\helpers\Url;
use yii\helpers\Html;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreAttribute;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreCategory;
use common\widgets\AdvantageWidget;
use yii\db\Expression;
use common\widgets\RentWidget;
use common\widgets\EtapWidget;
use common\widgets\LicenseWidget;
use common\widgets\ServicesWidget;
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
//$product=StoreProduct::find()->where(['id'=>$model->product_id])->one();
//!empty($product)? $collection=StoreProducer::find()->where(['id'=>$product->producer_id])->one(): $collection='';
$this->title = $titl;
!empty($model->category_id)? $this->params['breadcrumbs'][] = ['label' => '/ Услуги '.StoreCategory::find()->where(['id'=>$model->category_id])->one()->title, 
'url' => "/services/".StoreCategory::find()->where(['id'=>$model->category_id])->one()->slug.""] : '';
$this->params['breadcrumbs'][] = '/ '.$model->title;
?>


<div class="conteiner product">
    <h1><?=$model->title?></h1>
    <ul id="reviewList">
        <?php
        foreach ($all_files as $slide){ ?>
            <li>
                <div class="slideBit">
                    <img src="/uploads/images/<?=$slide?>" alt="<?=$model->title?>">
                    <div class="txtBox">
                        <div class="conteiner">				
                            <div class="slideText"></div>
                        </div>
                    </div>		
                </div>		
            </li>
        <?php } ?>
    </ul>
    <div class="opisanie">
            <?=$model->description?>
    </div>
</div>

<?=EtapWidget::widget(); ?>
<?=RentWidget::widget(); ?>
<?=LicenseWidget::widget(); ?>
<?php if($reviews != []){
    ?>
<div class="reviews">
    
    <div class="conteiner">
        <h2>Отзывы о услуге</h2>
        <ul id="reviewListUs">
            <?php
            foreach ($reviews as $slide){ ?>
                <li>
                    <div class="slideBit">
                        <img src="/images/back_rev.png" alt="<?=$slide->name?>">
                        <div class="txtBox">
                            <div class="conteiner">				
                                <div class="slideText"><?=$slide->description?>
                                    </br></br><p><b><?=$slide->name?></b></p><p><?=$slide->company?></p></div>
                            </div>
                        </div>		
                    </div>		
                </li>
            <?php } ?>
        </ul>
        <span class="kav"></span>
    </div>
</div>
<?php } ?>
<?=ServicesWidget::widget(); ?>
