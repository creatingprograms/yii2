<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Document */

$this->title = 'Редактировать документ: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

if(Yii::$app->user->getIdentity()->isUser() || Yii::$app->user->getIdentity()->isSub()|| Yii::$app->user->isGuest){

?>

	<div class="main-block-center">
		<div class="load-file">
			<h1>Объект: <?=$project->title?></h1>

			<p class="headline">Этап: <?=$events[$model->event_id]?><br> 
			<?= !empty($event->description)? $event->description : 'Описание события отсутствует.'?>
			</p>

			<?= $this->render('_formdoc', [
				'model' => $model,
				'type' => $type,
				'projects' => $projects,
				'events' => $events,		
			]) ?>
		</div>
	</div>
 <?php }else{ ?>

	<div class="document-update">

		<h1><?= Html::encode($this->title) ?></h1>

		<?= $this->render('_form', [
			'model' => $model,
			'type' => $type,
			'projects' => $projects,
			'events' => $events,		
		]) ?>

	</div>
 <?php } ?>