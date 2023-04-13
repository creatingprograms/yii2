<?php
namespace common\widgets;

use yii\base\Widget;
use backend\models\Slider;
use backend\models\Slideritem;

class SliderWidget extends Widget
{
    public function init(){}
    
    public function run()
    {
        $slider = Slider::find()->where(['status'=>'1'])->where(['code'=>'index-slider'])->one();
        if(!empty($slider)){
            $slides = Slideritem::find()->where(['slider_id'=>$slider->id])->all();
            if(count($slides) == 1){
                $slides = Slideritem::find()->where(['slider_id'=>$slider->id])->one();
            }
            return $this->render('slider', ['slides'=>$slides]);
        }
        return false;
    }
}