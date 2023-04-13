<?php
namespace common\widgets;

use Yii;
use yii\base\Widget;
use backend\models\Notification;

class NotWidget extends Widget
{
    public function init(){}
    
    public function run()
    {
		if (Yii::$app->user->getIdentity()->isAdmin()){
			$nots = Notification::find()->where(['status_ad'=>1])->all();
		}else if(Yii::$app->user->getIdentity()->isManager()){
			$nots = Notification::find()->where(['status_men'=>1])->andWhere(['manager_id' => Yii::$app->user->id])->all();
		}else if(Yii::$app->user->getIdentity()->isUser()){
			$nots = Notification::find()->where(['status_us'=>1])->andWhere(['user_id' => Yii::$app->user->id])->all();
		}else if(Yii::$app->user->getIdentity()->isSub()){
			$nots = Notification::find()->where(['status_sub'=>1])->andWhere(['sub_id' => Yii::$app->user->id])->all();
		}
		return $this->render('not', ['nots'=>$nots]);
    }
}