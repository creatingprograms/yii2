<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Infoblock */

$this->title = 'Редактировать инфоблок: ' . $model->title;
?>
<div class="infoblock-update">
    <?= $this->render('_form', [
        'model' => $model,
        'records' => $records,
    ]) ?>

</div>
