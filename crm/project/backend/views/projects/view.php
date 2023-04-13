<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use backend\models\Status;
use yii\grid\GridView;
use backend\models\Projects;
use backend\models\Event;
use backend\models\Document;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
			'number',
            'address:ntext',
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
				'value' => function ($model, $key) {
					$type = ['1' => 'Часный дом', '2' => 'Многоквартирный дом', '3' => 'Комерческое здание', '4' => 'Другое'];
					return \yii\helpers\Html::tag(
						'span',
						$model->type != 0 ? $type[$model->type] : 'Тип объекта не выбран',
						[
							'class' => '',
						]
					);
				},
			],
			'description:ntext',
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
        ],
    ]) ?>


	<?php 
		if(Yii::$app->user->getIdentity()->isUser() || Yii::$app->user->getIdentity()->isManager() || Yii::$app->user->getIdentity()->isAdmin()){ ?>
		
		<br><br><h2 class="modal__title">Перечень документов по договору "<?= Html::encode($this->title) ?>":</h2>
	<div class="table-plan">
		<div class="table-plan__wrap">
			<div class="table-plan__header">
				 <?= GridView::widget([
					'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $dataDocument]),
					'filterModel' => $searchDocument,
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
								 return !empty($data->project_id)? Projects::findOne(['id'=>$data->project_id])->title: '';
							},
						],
						[
							'attribute' => 'event_id',
							'value' => function ($data) {
								 return !empty($data->event_id) ? Event::findOne(['id'=>$data->event_id])->title: '';
							},
						],
						[
							'attribute' => 'type_id',
							'format' => 'raw',
							'filter' => ['1' => 'создан', '2' => 'ожидает', '10' => 'загружен'],
							'value' => function ($event, $key, $index, $column) {
								$type = ['1' => 'создан', '2' => 'ожидает', '10' => 'загружен'];
								return \yii\helpers\Html::tag(
									'span',
									$event->type_id != 0 ? $type[$event->type_id] : 'без прогресса',
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
							'class' => 'yii\grid\ActionColumn',
							'header' => '',
							'headerOptions' => ['width' => '200'],
							'template' => '{download}',
							'buttons' => [
								'download' => function ($url,$event,$key) {
										return Html::a('Загрузить', $event->link, ['class'=>'update_link_lk', 'data-pjax' => '0', 'target' => '_blank']);
									},
							],
						],
					],
				]); ?>
			</div>
			</div>
		</div>
		
		
		<br><br>
		<div style="overflow: hidden;">
			<div style="display: block; float: left;">
				<h2 class="modal__title">События по договору "<?= Html::encode($this->title) ?>":</h2>
			</div>
			<?php 
			if(!Yii::$app->user->getIdentity()->isUser()){ ?>
				<?=Html::a('Добавить этап', ['event/create'], ['class' => 'btn btn-success btn--add']);?>
			<?php } ?>
		</div>
	
	<div class="table-plan">
		<div class="table-plan__wrap">
			<div class="table-plan__header">
				 <?= GridView::widget([
					'dataProvider' =>	new \yii\data\ActiveDataProvider(['query' => $dataEvent]),
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
								 return !empty($data->project_id)? Projects::findOne(['id'=>$data->project_id])->title: '';
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
	
<div id="calendar">

</div>
	
<script>var events = <?=$data_ev?>;<?php if(!empty($not)){ ?>var not = <?=$not?>;<?php }else{ ?>var not = null;<?php } ?></script>
		<?php } ?>
</div>
<?php
    yii\bootstrap\Modal::begin([
        'id'=>'modal-list-event',
        'class'=>'modal',
    ]);
    yii\bootstrap\Modal::end();

    yii\bootstrap\Modal::begin([
        'id'=>'modal-view-event',
        'class'=>'modal',
    ]);
    yii\bootstrap\Modal::end();

if(!Yii::$app->user->getIdentity()->isUser()){
    // add & edit event
    yii\bootstrap\Modal::begin([
        'id'=>'modal-add-event',
        'class'=>'modal modal_add',
    ]);
    yii\bootstrap\Modal::end();

    // add user
    /*yii\bootstrap\Modal::begin([
        'id'=>'modal-add-user',
        'class'=>'modal modal_add',
    ]);
    yii\bootstrap\Modal::end();*/
}
?>