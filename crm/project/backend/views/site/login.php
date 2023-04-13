<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Авторизация';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

    <div class="page-container container">
        <div class="main-block-center">
            <div class="auth">
                <div class="myhead">
                    <img src="../img/logo.svg" />
                </div>
                <div class="mybody">

                <h1>Авторизация</h1>

<?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'auth__form form', 'enableClientValidation' => false]); ?>

<?= $form
    ->field($model, 'email')
    ->label(false)
    ->textInput(['placeholder' => $model->getAttributeLabel('email'), 'class' => 'input__elem']) ?>

<?= $form
    ->field($model, 'password', $fieldOptions2)
    ->label(false)
    ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'class' => 'input__elem']) ?>

<div class="form__footer">
    <div class="input m-0">
        <?= $form->field($model, 'rememberMe')->checkbox(['template' => '{input}{label}{error}'])->label('Запомнить меня', ['class' => 'input__checkbox-label']) ?>
    </div>

    <div class="form__send">
        <?= Html::submitButton('Войти', ['class' => 'btn btn--tiny btn--accent', 'name' => 'login-button']) ?>
    </div>
    <!-- /.col -->
                </div>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
