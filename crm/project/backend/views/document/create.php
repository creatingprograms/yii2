<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Document */

$this->title = 'Добавить документ';
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'type' => $type,
		'projects' => $projects,
		'events' => $events
    ]) ?>

</div>
