<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\News */

$this->title = 'Редактирование новости: ' . $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-update">
    <?= $this->render('_form', [
        'model' => $model,
		'all_file' => $all_file,
		'doc_file' => $doc_file,
    ]) ?>

</div>