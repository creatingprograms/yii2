<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProducer */

$this->title = 'Добавить коллекцию';
?>
<div class="store-producer-create">

    <?= $this->render('_form', [
        'model' => $model,
        'all_file' => '',
    ]) ?>

</div>
