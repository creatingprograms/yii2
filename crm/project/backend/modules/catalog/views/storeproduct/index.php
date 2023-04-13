<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Услуги';
?>
<div class="store-product-index">

    <p>
        <?= Html::a('Добавить услугу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'producer_id',
            //'type',
            //'category_id',
			[
				'attribute' => 'category_id',
				'value' => function ($data) {
					 return !empty($data->category_id)? StoreCategory::findOne(['id'=>$data->category_id])->title: '';
				},
				//'value' => 'menu.name',
			],
            //'sku',
            'title',
            'slug',
            //'price',
            //'discount_price',
            //'discount',
            //'short_description:ntext',
            //'description:ntext',
            //'status',
            //'imageFile:ntext',
            //'allFile:ntext',
            //'meta_title:ntext',
            //'meta_keywords:ntext',
            //'meta_description:ntext',
            //'parent_id',
            //'position',
            //'infoblock_id',
            //'create_time',
            //'update_time',
            //'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '30'],
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url,$model,$key) {
                            return Html::a('Редактировать', $url, ['class' => 'btn btn-success btn-xs']);
                        },
                    'delete' => function ($url,$model,$key) {
                            return Html::a('Удалить', $url, ['class' => 'btn btn-danger btn-xs', 'data-pjax' => '0', 'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?', 'data-method' =>'post']);
                        },
				],
            ],
        ],
    ]); ?>


</div>
