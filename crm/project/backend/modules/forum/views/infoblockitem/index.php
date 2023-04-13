<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\modules\forum\models\Infoblock;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InfoblockItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукция в инфоблоках';
?>
<div class="infoblock-item-index">

    <p>
        <?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'infoblock_id',
			[
				'attribute' => 'infoblock_id',
				'value' => function ($data) {
					 return Infoblock::findOne(['id'=>$data->infoblock_id])->title;
				},
				//'value' => 'menu.name',
			],
            'title',
            //'anons:ntext',
            //'imageFile:ntext',
            //'allFile:ntext',
            //'description:ntext',
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
