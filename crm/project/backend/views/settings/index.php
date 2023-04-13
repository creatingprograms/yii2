<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Settings */

$this->title = 'Редактировать настройки';
?>
<div class="settings-update">

    <?= $this->render('_form', [
        'settings' => $settings,
        'model' => $model,
        'model1' => $model1,
    ]) ?>

</div>
