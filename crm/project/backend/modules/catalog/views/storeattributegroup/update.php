<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreAttributeGroup */

$this->title = 'РЕдактирование фильтра: ' . $model->name;
?>
<div class="store-attribute-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
