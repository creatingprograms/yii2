<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Record */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="record-view">
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'smallImage:image',
            'id',
            'title',
            'slug:ntext',
            'description:ntext',
            'infoblock_id',
            'title_file',
            'allFile:ntext',
            'link',
            'text_link',
            'category_id',
            'created_at',
        ],
    ]) ?>

</div>
