<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoreProductLinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Product Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-product-link-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Store Product Link', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            'linked_product_id',
            'type',
            'position',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '30'],
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
