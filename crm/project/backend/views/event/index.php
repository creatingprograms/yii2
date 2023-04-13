<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\grid\GridView;
use backend\models\Project;
use backend\models\Document;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-table__header event_calendar">

    <?php 
    if(!Yii::$app->user->getIdentity()->isUser()){ ?>
        <?=Html::a('Добавить этап', ['create'], ['class' => 'btn btn-success btn--add btn-event-add']);?>
    <?php } ?>

	<?php //echo Yii::$app->user->getIdentity()->isUser() ? '' : Html::a('Запрос на добавление документа от клиента', ['/document/create'], ['class' => 'btn btn-success btn--add btn-doc-add']) ?>
	
	<?php 
	if(!Yii::$app->user->getIdentity()->isSub()){
		if (count($projects) > 1){
		$form = ActiveForm::begin([
			'fieldConfig' => [
				'template' => "{input}{label}{error}",
					'options' => [
						'class' => 'input form-group form-filter-object'
					]
		],
		]); ?>
		<?= $form->field($model, 'id', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Объект', ['class' => 'input__elem-label'])->widget(Select2::classname(), [
		'data' => $projects,
		//'value' => '',
		'options' => [
			'placeholder' => 'Выберите объект...',
			//'multiple' => true
		],
		'pluginOptions' => [
			//'minimumInputLength' => 1,
			//'allowClear' => true
		],
		])
		?>
		<?php //$form->field($model, 'id', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Объект', ['class' => 'input__elem-label'])->dropDownList($projects)
		
		?>
		<?= Html::submitButton('Фильтровать', ['class' => 'btn btn-success form-filter-object-btn']) ?>

	<?php ActiveForm::end(); } } ?>
</div>
<div id="calendar">

</div>
	<?php 
	if(!Yii::$app->user->getIdentity()->isSub()){ ?>
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
<?php } ?>
<script>var events = <?=$data?>;<?php if(!empty($not)){ ?>var not = <?=$not?>;<?php }else{ ?>var not = null;<?php } ?></script>
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