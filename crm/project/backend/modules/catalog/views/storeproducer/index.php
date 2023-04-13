<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreProducerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Коллекции';
?>
<div class="store-producer-index">

    <p>
        <?= Html::a('Добавить коллекцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'anons',
            'slug',
            //'imageFile:ntext',
            //'allFile:ntext',
            //'short_description:ntext',
            //'description:ntext',
            //'status',
            //'sort',
            //'meta_title:ntext',
            //'meta_keywords:ntext',
            //'meta_description:ntext',

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
