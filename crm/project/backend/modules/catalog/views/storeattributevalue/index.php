<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\catalog\models\StoreAttributeValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Атрибуты товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-attribute-value-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            'attribute_id',
            'number_value',
            'string_value',
            //'text_value:ntext',
            //'option_value',
            //'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
