<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\SliderWidget;
use common\widgets\ProductionWidget;
use common\widgets\AdvantageWidget;
use common\widgets\ProductSaspackWidget;
use common\widgets\CooperationWidget;
use common\widgets\RentWidget;
use common\widgets\ServicesWidget;
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
$this->title = $model->title;
$this->params['breadcrumbs'][] = '/ '.$this->title;
?>
<div class="wrapper wrapper_large">

    <div class="conteiner">
        <h1><?=$model->title?></h1>
        <?=$model->description?>
    </div>
    
<?=RentWidget::widget(); ?>
<?=ServicesWidget::widget(); ?>
</div>
    
