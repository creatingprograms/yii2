<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProducerItem */

$this->title = 'Редактирование элемента коллекции: ' . $model->title;
?>
<div class="store-producer-item-update">

    <?= $this->render('_form', [
        'model' => $model,
        'producer' => $producer,
    ]) ?>

</div>
