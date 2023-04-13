<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreProduct */

$this->title = 'Добавить услугу';
?>
<div class="store-product-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'records' => $records,
        'producer' => $producer,
        'all_file' => '',
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'searchModel1' => $searchModel1,
        'dataProvider1' => $dataProvider1,
        'filters' => $filters,
        'filters1' => $filters1,
        'link_type' => $link_type,
        'filter_item' => $filter_item,
        'filter_item1' => $filter_item1,
    ]) ?>

</div>
