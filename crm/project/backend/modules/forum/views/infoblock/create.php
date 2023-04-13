<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Infoblock */

$this->title = 'Создать инфоблок';
?>
<div class="infoblock-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'records' => $records,
    ]) ?>

</div>
