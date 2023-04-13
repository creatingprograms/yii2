<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\multiselect\MultiSelect;
use backend\models\Project;
use backend\models\Document;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
	<div class="data-table__header">
		<?= Yii::$app->user->getIdentity()->isUser() ? '' : Html::a('Добавить этап', ['create'], ['class' => 'btn btn-success btn--add btn-event-add']) ?>
		<?= $this->render('_search', ['model' => $searchModel]) ?>
	</div>

	<div class="table-plan">
		<div class="table-plan__wrap">
			<div class="table-plan__header">
				 <?= GridView::widget([
					'dataProvider' =>	Yii::$app->user->getIdentity()->isUser() ? new \yii\data\ActiveDataProvider(['query' => $dataProvider]) : $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						[
							'class' => 'yii\grid\ActionColumn',
							'header' => 'Название',
							'headerOptions' => ['width' => '200'],
							'template' => '{update}',
							'buttons' => [
								'update' => function ($url,$model,$key) {
										return Html::a($model->title, $url, ['class'=>'update_link', 'data-pjax' => '0']);
									},
							],
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
						[
							'attribute' => 'created_at',
							'value' => function ($data) {
								 return !empty($data->created_at) ? date('d-m-Y', $data->created_at) : '';
							},
						],
					],
				]); ?>
			</div>
		</div>
	</div>

</div>
<?php
yii\bootstrap\Modal::begin([
    'id'=>'modal-add-event',
    'class'=>'modal modal--open modal--fadeIn',
]);
 yii\bootstrap\Modal::end();
 ?>
