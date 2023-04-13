<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="contacts">
    <div class="conteiner map_content short-nav__wrapper custom-scroll custom-scroll__transparent">
        <div class="short-nav">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7d85f735e9229dc3ddb0b0755c6623c3871402c2d1288a3e9975e0a802626699&amp;width=100%25&amp;height=350&amp;lang=ru_RU&amp;scroll=true"></script>
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
			<?= $form->field($model, 'phone')->textInput(['class' => 'form-check-input input input_default phone-mask', 'placeholder' => 'Введите номер телефона', 'name'=>'phone'])->label('') ?>
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
</div>