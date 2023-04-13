<?php
namespace common\widgets;

use Yii;
use yii\base\Widget;
use backend\models\Constructor;
use backend\models\Constructform;
use frontend\models\CalcForm;

class CalculatorWidget extends Widget
{
    public function init(){}
    
    public function run()
    {
        $calculatios = Constructor::find()->where(['parent_id'=>'0'])->all();
        $model1 = new CalcForm();
        if ($model1->load(Yii::$app->request->post()) && $model1->validate()) {
            if ($model1->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Спасибо за ваше письмо. Мы свяжемся с вами в ближайшее время.');
                $mail = new Constructform();
                $mail->name = $model1->name;
                $mail->phone = $model1->phone;
                $mail->nabor1 = $model1->nabor1;
                //$mail->created_at = $time->format('Y-m-d H:m:s');
                $mail->save();
                //return $this->render('index', compact('model', 'answer'));

            } else {
                    Yii::$app->session->setFlash('error', 'Ошибка отправки почты.');
            }

            return $this->refresh();
        } else {
            return $this->render('calculator', [
                'model' => $model1,
                'calculatios' => $calculatios,
            ]);
        }
    }
}