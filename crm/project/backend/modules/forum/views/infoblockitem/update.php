<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InfoblockItem */

$this->title = 'Редактировать товар инфоблока: ' . $model->title;
?>
<div class="infoblock-item-update">

    <?= $this->render('_form', [
        'model' => $model,
        'all_file' => $all_file,
        'infoblocks' => $infoblocks,
    ]) ?>

</div>
