<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Project;
use backend\models\Document;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description',
			[
				'attribute' => 'type',
				'format' => 'raw',
				'value' => function ($model, $key) {
					$type = ['1' => 'Да', '2' => 'нет'];
					return \yii\helpers\Html::tag(
						'span',
						$model->type != 0 ? $type[$model->type] : 'Тип объекта не выбран',
						[
							'class' => '',
						]
					);
				},
			],
			[
				'attribute' => 'status',
				'format' => 'raw',
				'value' => function ($model, $key) {
					$status = ['1' => 'Открыто', '2' => 'В работе', '3' => 'Завершено'];
					return \yii\helpers\Html::tag(
						'span',
						$model->status != 0 ? $status[$model->status] : 'Тип объекта не выбран',
						[
							'class' => '',
						]
					);
				},
			],
			[
				'attribute' => 'created_at',
				'value' => function ($data) {
					 return !empty($data->created_at) ? date('d-m-Y', $data->created_at) : '';
				},
			],
			[
				'attribute' => 'updated_at',
				'value' => function ($data) {
					 return !empty($data->updated_at) ? date('d-m-Y', $data->updated_at) : '';
				},
			],
			[
				'attribute' => 'project_id',
				'value' => function ($data) {
					 return !empty($data->project_id)? Project::findOne(['id'=>$data->project_id])->title: '';
				},
			],
			[
				'attribute' => 'document_id',
				'value' => function ($data) {
					 return !empty($data->document_id) ? Document::findOne(['id'=>$data->document_id])->title: '';
				},
			],
        ],
    ]) ?>

</div>
