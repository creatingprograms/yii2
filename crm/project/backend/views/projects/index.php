<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\multiselect\MultiSelect;
use backend\models\User;
use backend\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Договора';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">
	<div class="data-table__header">
		<?= Yii::$app->user->getIdentity()->isUser() ? '' : Html::a('Добавить новый договор', ['create'], ['class' => 'btn btn-success']) ?>
		<?= $this->render('_search', ['model' => $searchModel]) ?>
	</div>
	<div class="table-plan">
		<div class="table-plan__wrap">
			<div class="table-plan__header">
				<?php if(Yii::$app->user->getIdentity()->isUser()){ ?>
				 <?= GridView::widget([
					'dataProvider' => $dataProvider,
					//'dataProvider' => new \yii\data\ActiveDataProvider(['query' => $dataProvider]),
					'filterModel' => $searchModel,
					'columns' => [
						[
							'attribute' => 'type',
							'format' => 'raw',
							'filter' => $type,
							'value' => function ($model, $key, $index, $column) {
								$type = ['1' => 'Часный дом', '2' => 'Многоквартирный дом', '3' => 'Комерческое здание', '4' => 'Другое'];
								return \yii\helpers\Html::tag(
									'span',
									$model->type != 0 ? $type[$model->type] : 'Тип не выбран',
									[
										'class' => '',
									]
								);
							},
						],
						'number',
						[
							'class' => 'yii\grid\ActionColumn',
							'header' => 'Название',
							'headerOptions' => ['width' => '200'],
							'template' => '{view}',
							'buttons' => [
								'view' => function ($url,$model,$key) {
										return Html::a($model->title, $url, ['class'=>'view_link', 'data-pjax' => '0']);
									},
							],
						],
						'address',
						/*[
							'attribute' => 'user_id',
							'value' => function ($data) {
								 return !empty($data->user_id)? User::findOne(['id'=>$data->user_id])->username: '';
							},
						],
						[
							'attribute' => 'manager_id',
							'value' => function ($data) {
								 return !empty($data->manager_id)? User::findOne(['id'=>$data->manager_id])->username: '';
							},
						],*/
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
					],
				]); ?>
				<?php }else{ ?>
				
				 <?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						[
							'attribute' => 'type',
							'format' => 'raw',
							'filter' => $type,
							'value' => function ($model, $key, $index, $column) {
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
						'number',
						[
							'class' => 'yii\grid\ActionColumn',
							'header' => 'Название',
							'headerOptions' => ['width' => '200'],
							'template' => '{updatename}<div class="crud">{update}| {view}| {delete}</div>',
							'buttons' => [
								'updatename' => function ($url,$model,$key) {
										return Html::a($model->title, '/for_admin/project/update?id='.$model->id, ['class'=>'update_link', 'data-pjax' => '0']);
									},
								'update' => function ($url,$model,$key) {
										return Html::a('Редактировать', $url, ['class'=>'update_link', 'data-pjax' => '0']);
									},
								'view' => function ($url,$model,$key) {
										return Html::a('Подробнее', $url, ['class'=>'view_link', 'data-pjax' => '0']);
									},
								'delete' => function ($url,$model,$key) {
										return '<span href='.$url.' class="delete_link">Удалить<span>';
									},
							],
						],
						'address',
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
							'attribute' => 'user_id',
							'value' => function ($data) {
								 return !empty($data->user_id)? User::findOne(['id'=>$data->user_id])->username : '';
							},
						],
						[
							'attribute' => 'manager_id',
							'value' => function ($data) {
								 return !empty($data->manager_id)? User::findOne(['id'=>$data->manager_id])->username: '';
							},
						],
					],
				]); ?>
				<?php } ?>
			</div>
		</div>
	</div>

</div>
<?php
yii\bootstrap\Modal::begin([
    'id'=>'modal-add-object',
    'class'=>'modal modal--open modal--fadeIn',
]);
 yii\bootstrap\Modal::end();
 ?>
