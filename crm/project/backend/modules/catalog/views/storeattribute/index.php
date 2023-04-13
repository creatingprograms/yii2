<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreAttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Элементы фильтров';
?>
<div class="store-attribute-index">

    <p>
        <?= Html::a('Добавить элемент фильтру', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'name',
            'title',
            //'type',
            'sort',
            //'slug',
            //'description:ntext',
            //'group_id',

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
