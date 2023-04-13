<?php
namespace common\widgets;

use Yii;
use yii\base\Widget;
use backend\modules\forum\models\Infoblock;
use backend\modules\forum\models\InfoblockItem;
use backend\models\Constructform;
use frontend\models\ContactForm;

class ServicesWidget extends Widget
{
    public function init(){}
    
    public function run()
    {
        $info = Infoblock::find()->where(['id'=>5])->one();
        $model1 = new ContactForm();
        if ($model1->load(Yii::$app->request->post()) && $model1->validate()) {
                if ($model1->sendEmail(Yii::$app->params['adminEmail'])) {
                    Yii::$app->session->setFlash('success', 'Спасибо за ваше письмо. Мы свяжемся с вами в ближайшее время.');
                    $mail = new Constructform();
                    $mail->name = $model1->name;
                    $mail->phone = $model1->phone;
                    //$mail->created_at = $time->format('Y-m-d H:m:s');
                    $mail->save();
                    //return $this->render('index', compact('model', 'answer'));

                } else {
                        Yii::$app->session->setFlash('error', 'Ошибка отправки почты.');
                }

                return $this->refresh();
            }elseif(!empty($info)){
                $infoblocks = InfoblockItem::find()->where(['infoblock_id'=>$info->id])->all();
                return $this->render('services', ['slides'=>$infoblocks, 'info'=>$info, 'model'=>$model1]);
            }
    }
}