<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventProject */

$this->title = 'Create Event Project';
$this->params['breadcrumbs'][] = ['label' => 'Event Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-project-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
