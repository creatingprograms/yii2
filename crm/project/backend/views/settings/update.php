<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = 'Редактировать настройки';
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="settings-update">

    <?= $this->render('_form', [
        'settings' => $settings,
    ]) ?>

</div>
