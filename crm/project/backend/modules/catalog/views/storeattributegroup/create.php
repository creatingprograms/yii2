<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreAttributeGroup */

$this->title = 'Добавить фильтр';
?>
<div class="store-attribute-group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
