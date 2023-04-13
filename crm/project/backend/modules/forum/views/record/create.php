<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Record */

$this->title = 'Добавить запись';
//$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-create">
    
    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'infoblocks' => $infoblocks,
        'countblocks' => $countblocks,
        'records' => $records,
		'all_file' => '',
		'all_file1' => '',
		'all_file2' => '',
		'all_file3' => '',
		'all_file4' => '',
    ]) ?>

</div>
