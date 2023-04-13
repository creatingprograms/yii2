<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\catalog\models\StoreProducer;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreProducerItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Элементы коллекций';
?>
<div class="store-producer-item-index">

    <p>
        <?= Html::a('Добавить элемент в коллекцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'producer_id',
			[
				'attribute' => 'producer_id',
				'value' => function ($data) {
					 return StoreProducer::findOne(['id'=>$data->producer_id])->title;
				},
				//'value' => 'menu.name',
			],
            'title',
            //'anons',
            'slug',
            //'imageFile:ntext',
            //'description:ntext',
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
