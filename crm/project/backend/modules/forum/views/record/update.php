<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Record */

$this->title = 'Редактировать запись: ' . $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="record-update">
    
    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'infoblocks' => $infoblocks,
        'records' => $records,
		'all_file' => $all_file,
		'all_file1' => $all_file1,
		'all_file2' => $all_file2,
		'all_file3' => $all_file3,
		'all_file4' => $all_file4,
        //'countblocks' => $countblocks,
    ]) ?>

</div>
