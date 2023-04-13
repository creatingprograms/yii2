<?php
namespace common\widgets;

use yii\base\Widget;
use backend\modules\forum\models\Infoblock;
use backend\modules\forum\models\InfoblockItem;

class LicenseWidget extends Widget
{
    public function init(){}
    
    public function run()
    {
        $info = Infoblock::find()->where(['id'=>6])->one();
        if(!empty($info)){
            $infoblocks = InfoblockItem::find()->where(['infoblock_id'=>$info->id])->all();
            return $this->render('license', ['slides'=>$infoblocks, 'info'=>$info]);
        }
        return false;
    }
}