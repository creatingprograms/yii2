<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = 'Редактировать настройки магазина';
?>
<div class="settings-update">

    <?= $this->render('_form', [
        'settings' => $settings,
        'model' => $model,
    ]) ?>

</div>