<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\SliderWidget;
use common\widgets\ProductionWidget;
use common\widgets\AdvantageWidget;
use common\widgets\ProductSaspackWidget;
use common\widgets\CooperationWidget;
use backend\models\Menuitem;
use backend\models\Menu;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreProduct;
use backend\modules\catalog\models\StoreAttributeValue;
use backend\modules\catalog\models\StoreAttribute;
use backend\models\Contacts;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use common\widgets\RentWidget;

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
$phone = Contacts::find()->where(['param_name'=>'phone'])->one();
$address = Contacts::find()->where(['param_name'=>'address'])->one();
$time = Contacts::find()->where(['param_name'=>'timeWork'])->one();
$email = Contacts::find()->where(['param_name'=>'email'])->one();
$ooo = Contacts::find()->where(['param_name'=>'ooo'])->one()->param_value;
$email_sales = Contacts::find()->where(['param_name'=>'emailSales'])->one();
$social = Contacts::find()->where(['param_name'=>'social'])->all();
$this->title = $siteName;

$this->title = $model->title;
$this->params['breadcrumbs'][] = '/ '. $this->title;
?>
<div class="contacts">

    <div class="conteiner cont">
        <h1><?=$model->title?></h1>
        <div class="address"><img class="icon_phone" src="/uploads/images/default/<?=$address->param_icon?>"><?=$address->param_value?></div>
        <div class="time"><img class="icon_phone" src="/uploads/images/default/<?=$time->param_icon?>"><?=$time->param_value?></div>
        <a class="phone" href="<?=$phone->param_link?>"><img class="icon_phone" src="/uploads/images/default/<?=$phone->param_icon?>"><?=$phone->param_value?></a>
        <a class="mail" href="<?=$phone->param_link?>"><img class="icon_phone" src="/uploads/images/default/<?=$email->param_icon?>"><?=$email->param_value?></a>
        <?php //$model->description?>
    </div>
    
    <div class="conteiner short-nav__wrapper custom-scroll custom-scroll__transparent">
        <div class="short-nav">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7d85f735e9229dc3ddb0b0755c6623c3871402c2d1288a3e9975e0a802626699&amp;width=100%25&amp;height=350&amp;lang=ru_RU&amp;scroll=true"></script>
		</div>
    </div>
    
    <div class="conteiner soc">
         <h1>Мы в социальных сетях</h1>
        <div class = "social">
            <?php foreach($social as $s){ ?>
            <a href="https://<?=$s->param_link?>" target="_blank"><img src="/uploads/images/default/<?=$s->param_icon?>"></a>
            <?php } ?>
        </div>
    </div>
    <div class="conteiner" id="service">
        <div class="form">
            <h3>Бесплатная консультация</h3>
            <p>Отправьте заявку и наши сотрудники свяжутся с Вами в ближайшее время</p>
            <?php Pjax::begin(['id' => 'service-pjax', 'enablePushState' => false, 'formSelector' => '#calcul-form']); ?>
            <?php $form = ActiveForm::begin([ 'id' => 'calcul-form', 'action' => '/svayz1.php', 'options' => ['data-pjax' => true], 'class'=>'calcul-form form',
            //                    'enableClientValidation'=> false,
                ]); ?>
            <div class="row row_t-reverce">
                <div class="col col--lg-6">
                    <div class="form__item">
			<?= $form->field($model1, 'phone')->textInput(['class' => 'form-check-input input input_default phone-mask', 'placeholder' => 'Введите номер телефона', 'name'=>'phone'])->label('') ?>
                    </div>
                    <div class="form__item">
                        <?= Html::submitButton('Хочу консультацию', ['class' => 'popup_btn']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            <p>Нажимая на кнопку даете согласие на
            <a href="/confidentiality">обработку персональных данных</a></p>
        </div>
    </div>
    <?=RentWidget::widget(); ?>
</div>
    
