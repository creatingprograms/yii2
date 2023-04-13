<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InfoblockItem */

$this->title = 'Добавить продукт инфоблока';
?>
<div class="infoblock-item-create">

    <?= $this->render('_form', [
        'model' => $model,
        'all_file' => '',
        'infoblocks' => $infoblocks,
    ]) ?>

</div>
