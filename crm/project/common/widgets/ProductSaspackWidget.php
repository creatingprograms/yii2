<?php
namespace common\widgets;

use yii\base\Widget;
use backend\modules\forum\models\Infoblock;

class ProductSaspackWidget extends Widget
{
    public function init(){}
    
    public function run()
    {
        $info = Infoblock::find()->where(['id'=>3])->one();
        if(!empty($info)){
            return $this->render('product_saspack', ['info'=>$info]);
        }
        return false;
    }
}