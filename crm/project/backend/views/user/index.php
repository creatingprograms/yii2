<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;

$this->title = 'Клиенты';
?>
<div class="user-index">
	<div class="data-table__header">
		<?= Html::a('Добавить клиента', ['create', 'role'=>'1'], ['class' => 'btn btn-success btn--add', 'data-role' => '1']) ?>
        <?=Html::a('Добавить менеджера', ['create', 'role'=>'5'], ['class' => 'btn btn-success btn--add', 'data-role' => '5']);?>
        <?=Html::a('Добавить субподрядчика', ['create', 'role'=>'2'], ['class' => 'btn btn-success btn--add', 'data-role' => '2']);?>
		<?php // echo $this->render('_search', ['model' => $searchModel]) ?>
	</div>
	<div class="table-plan">
		<div class="table-plan__wrap">
			<div class="table-plan__header">
				<?php \yii\widgets\Pjax::begin(); ?>
				 <?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					//'layout' => "{pager}\n{summary}\n{items}\n{pager}",
					//'summary' => 'Показано {begin} - {end} из {totalCount}',
					'summaryOptions' => [
						'class' => 'summary'
					],
					'columns' => [
						[
							'class' => 'yii\grid\ActionColumn',
							'header' => 'Клиент',
							'headerOptions' => ['width' => '300'],
							'template' => '{nameupdate}<div class="crud">{update}| {view}| {delete}</div>',
							'buttons' => [
								'nameupdate' => function ($url,$model,$key) {
										return Html::a($model->username, $url, ['class'=>'update_link', 'data-pjax' => '0']);
									},
								'update' => function ($url,$model,$key) {
										return Html::a('Редактировать', $url, ['class'=>'update_link', 'data-pjax' => '0']);
									},
								'view' => function ($url,$model,$key) {
										return Html::a('Подробнее', $url, ['class'=>'view_link', 'data-pjax' => '0']);
									},
								'delete' => function ($url,$model,$key) {
										return $model->role != '10' ? '<span href='.$url.' class="delete_link">Удалить<span>' : '';
									},
							],
						],
						'email',
						'phone',
						//'description:ntext',
						[
							'attribute' => 'active',
							'format' => 'raw',
							'filter' => [
								1 => 'Да',
								0 => 'Нет',
							],
							'value' => function ($model, $key, $index, $column) {
								$active = $model->{$column->attribute} === "1";
								return \yii\helpers\Html::tag(
									'div',
									$active ? '<input type="checkbox" active="1" id='.$model->id.' checked>' : '<input type="checkbox" id='.$model->id.' active="0">',
									[
										'class' => 'switch',
									]
								);
							},
						],
						[
							'attribute' => 'role',
							'format' => 'raw',
							'filter' => [
								1 => 'Клиент',
								2 => 'Субподрядчик',
								5 => 'Менеджер',
								10 => 'Администратор',
							],
							'value' => function ($data) {
								$role = [1 => 'Клиент', 5 => 'Менеджер', 2 => 'Субподрядчик', 10 => 'Администратор'];
								return $role[$data->role];
							},
						],
						['attribute' => 'created_at', 'format' => ['date', 'php:d-m-Y H:i']],
					],
				]); ?>
				<?php \yii\widgets\Pjax::end(); ?>
			</div>
		</div>
	</div>
</div>
<?php
yii\bootstrap\Modal::begin([
    'id'=>'modal-add-user',
    'class'=>'modal modal--open modal--fadeIn',
]);
 yii\bootstrap\Modal::end();
 ?>