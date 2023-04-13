<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreAttribute */

$this->title = 'Редактирование элемента фильтра: ' . $model->name;
?>
<div class="store-attribute-update">

    <?= $this->render('_form', [
        'model' => $model,
        'filter' => $filter,
    ]) ?>

</div>
