<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InfoblockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Инфоблоки';
?>
<div class="infoblock-index">
    <p>
        <?= Html::a('Создать инфоблок', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'alias',
            //'description:ntext',
            //'allFile:ntext',
            //'imageFile:ntext',
            //'type:ntext',
            //'link:ntext',
            //'indexok:ntext',
            //'smallImage:image',
            //'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '30'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model,$key) {
                            return Html::a('Редактировать', $url, ['class' => 'btn btn-success btn-xs']);
                        },
				],
            ],
        ],
    ]); ?>


</div>
