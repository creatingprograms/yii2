<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\StoreAttributeValue */

$this->title = 'Редактировать атрибута: ' . $model->id;
?>
<div class="store-attribute-value-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
