<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProducer */

$this->title = 'Редактирование коллекции: ' . $model->title;
?>
<div class="store-producer-update">

    <?= $this->render('_form', [
        'model' => $model,
        'all_file' => $all_file,
    ]) ?>

</div>
