<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PageblockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pageblocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pageblock-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать Pageblock', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            
            [
                'attribute' => 'staticpage_id',
                'value' => 'staticpage.title',
            ],
            [
                'attribute' => 'infoblock_id',
                'value' => 'infoblock.title',
            ],
            
            'infoblock_id',
            'staticpage_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
