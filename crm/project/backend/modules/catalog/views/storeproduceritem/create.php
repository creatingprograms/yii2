<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProducerItem */

$this->title = 'Добавить элемент в коллекцию';
?>
<div class="store-producer-item-create">

    <?= $this->render('_form', [
        'model' => $model,
        'producer' => $producer,
    ]) ?>

</div>
