<?php
namespace common\widgets;

use Yii;
use yii\base\Widget;
use backend\modules\forum\models\Infoblock;

class CooperationWidget extends Widget
{
    public function init(){}
    
    public function run()
    {
        $info = Infoblock::find()->where(['id'=>4])->one();
		return $this->render('cooperation', [
			'info'=>$info,
		]);
    }
}