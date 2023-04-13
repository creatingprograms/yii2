<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории товаров';
?>
<div class="store-category-index">
    <p>
        <?= Html::a('Создать категорию товаров', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
			[
				'attribute' => 'parent_id',
				'label' => 'Родительская категория',
				'value' => 'parent.title',
			],
            'slug',
            //'imageFile:ntext',
            //'short_description:ntext',
            //'description:ntext',
            //'meta_title:ntext',
            //'meta_description:ntext',
            //'meta_keywords:ntext',
            //'status',
            //'sort',
            //'type',
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
