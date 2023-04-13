<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = 'Редактировать этап: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'projects' => $dataSpr['projects'],
        'clients' => $dataSpr['clients'],
        'typeSpr' => $dataSpr['type'],
		'status' => $dataSpr['status'],
		'sub' => $dataSpr['sub']
    ]) ?>

</div>

<?php
$this->registerJs("$('#event-created_at').mask('9999-99-99', {placeholder: 'YYYY-MM-DD' });
					$('#event-created_at').datepicker({
						minDate: 0,
						dateFormat: 'yy-mm-dd'
					});");