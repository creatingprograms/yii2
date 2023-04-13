<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProduct */

$this->title = 'Редактирование услуги: ' . $model->title;
?>
<div class="store-product-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'records' => $records,
        'producer' => $producer,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'searchModel1' => $searchModel1,
        'dataProvider1' => $dataProvider1,
        'filters' => $filters,
        'filters1' => $filters1,
        'all_file' => $all_file,
        'link_type' => $link_type,
        'filter_item' => $filter_item,
        'filter_item1' => $filter_item1,
    ]) ?>

</div>
