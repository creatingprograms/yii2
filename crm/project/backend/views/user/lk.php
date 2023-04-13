<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;
use backend\models\Status;
use backend\models\Project;
use backend\models\Document;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Персональные данные';
?>
<div class="user-update">

    <h2 class="modal__title"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
		'projects' => $projects,
		'projects_for' => $projects_for,
		'project_men' => $project_men,
		'get_r' => $get_r
    ]) ?>

	<?php 
		if(Yii::$app->user->getIdentity()->isUser() || Yii::$app->user->getIdentity()->isManager()){ ?>
		<br><br>
    <h2 class="modal__title">Мои договоры:</h2>

	<div class="table-plan">
		<div class="table-plan__wrap">
			<div class="table-plan__header">
				 <?= GridView::widget([
					'dataProvider' =>	Yii::$app->user->getIdentity()->isUser() ? new \yii\data\ActiveDataProvider(['query' => $dataProject]) : $dataProject,
					'filterModel' => $searchProject,
					'columns' => [
						[
							'class' => 'yii\grid\ActionColumn',
							'header' => 'Договор',
							'headerOptions' => ['width' => '200'],
							'template' => '{view}',
							'buttons' => [
								'view' => function ($url,$project,$key) {
										return Html::a($project->title, '/for_admin/project/view?id='.$project->id, ['class'=>'update_link_lk', 'data-pjax' => '0']);
									},
							],
						],
						'address',
						[
							'attribute' => 'manager_id',
							'value' => function ($data) {
								 return !empty($data->manager_id)? User::findOne(['id'=>$data->manager_id])->username: '';
							},
						],
						'area',
						[
							'attribute' => 'status_id',
							'format' => 'raw',
							'filter' => $sts,
							'value' => function ($data) {
								 return !empty($data->status_id) ? Status::findOne(['id'=>$data->status_id])->title : '';
							},
							//'value' => 'menu.name',
						],
						[
							'attribute' => 'type',
							'format' => 'raw',
							'filter' => $type,
							'value' => function ($project, $key, $index, $column) {
								$type = ['1' => 'Часный дом', '2' => 'Многоквартирный дом', '3' => 'Комерческое здание', '4' => 'Другое'];
								return \yii\helpers\Html::tag(
									'span',
									$project->type != 0 ? $type[$project->type] : 'Тип объекта не выбран',
									[
										'class' => '',
									]
								);
							},
						],
					],
				]); ?>
			</div>
		</div>
	</div>
    <h2 class="modal__title">События по договорам:</h2>
	
	<div class="table-plan">
		<div class="table-plan__wrap">
			<div class="table-plan__header">
				 <?= GridView::widget([
					'dataProvider' =>	Yii::$app->user->getIdentity()->isUser() ? new \yii\data\ActiveDataProvider(['query' => $dataEvent]) : $dataEvent,
					'filterModel' => $searchEvent,
					'columns' => [
						[
							'class' => 'yii\grid\ActionColumn',
							'header' => 'Название',
							'headerOptions' => ['width' => '200'],
							'template' => '{view}',
							'buttons' => [
								'view' => function ($url,$event,$key) {
										return Html::a($event->title, '/for_admin/event/view?id='.$event->id, ['class'=>'update_link_lk', 'data-pjax' => '0']);
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
							'attribute' => 'status',
							'format' => 'raw',
							'filter' => ['1' => 'создано', '2' => 'на очереди', '3' => 'выполнено', '4' => 'закрыто'],
							'value' => function ($event, $key, $index, $column) {
								$status = ['1' => 'создано', '2' => 'на очереди', '3' => 'выполнено', '4' => 'закрыто'];
								return \yii\helpers\Html::tag(
									'span',
									$event->status != 0 ? $status[$event->status] : 'без прогресса',
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
					],
				]); ?>
			</div>
		</div>
	</div>
	
	
		<?php } ?>
</div>