<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\StoreProduct */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Store Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'producer_id',
            'type',
            'category_id',
            'sku',
            'title',
            'slug',
            'price',
            'discount_price',
            'discount',
            'short_description:ntext',
            'description:ntext',
            'status',
            'imageFile:ntext',
            'allFile:ntext',
            'meta_title:ntext',
            'meta_keywords:ntext',
            'meta_description:ntext',
            'parent_id',
            'position',
            'infoblock_id',
            'create_time',
            'update_time',
            'user_id',
        ],
    ]) ?>

</div>
