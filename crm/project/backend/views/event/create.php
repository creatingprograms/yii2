<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */

$this->title = 'Добавить этап';
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="modal_head">
		<h2 class="modal__title"><?= Html::encode($this->title) ?></h2>
	</div>

    <?= $this->render('_form', [
        'model' => $model,
        'projects' => $dataSpr['projects'],
        'clients' => $dataSpr['clients'],
        'typeSpr' => $dataSpr['type'],
		'status' => $dataSpr['status'],
		'sub' => $dataSpr['sub']
    ]) ?>
