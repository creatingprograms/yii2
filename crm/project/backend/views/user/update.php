<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'Редактировать клиента: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h2 class="modal__title"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
		'projects' => $projects,
		'projects_for' => $projects_for,
		'project_men' => $project_men,
		'type' => $type,
		'get_r' => $get_r
    ]) ?>

</div>
<?php
$this->registerJs("$(document).on('click', '#user-active', function(){
		if($(this).prop('checked')){
			$('.is_active').html('АКТИВНЫЙ');
		}else{
			$('.is_active').html('НЕ АКТИВНЫЙ');
		}
	});
	$('.modal-body').on('click', '.input--btn-delete', function(e){
		e.preventDefault();
		$('#user-password').val('');
	});
	$('.modal-body').on('click', '.input--btn-refresh', function(e){
		e.preventDefault();
		var length = 8,
		charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		res = '';
		for (var i = 0, n = charset.length; i < length; ++i) {
			res += charset.charAt(Math.floor(Math.random() * n));
		}
		$('#user-password').val(res);
	});
	$('input[type=phone]').mask('+7 (999) 999-99-99', {autoclear: false}");