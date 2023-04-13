<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreAttribute */

$this->title = 'Добавить элемент фильтра';
?>
<div class="store-attribute-create">

    <?= $this->render('_form', [
        'model' => $model,
        'filter' => $filter,
    ]) ?>

</div>
