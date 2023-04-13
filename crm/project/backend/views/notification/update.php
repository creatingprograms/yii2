<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Notification */

$this->title = 'Редактирование уведомления: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notification-update">

<?php 
	if(Yii::$app->user->getIdentity()->isUser()){
		?>
		<h1><?= Yii::$app->user->getIdentity()->username ?></h1>
		<h2>Подтвердите действие:</h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	<?php }else{
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

<?php } ?>
</div>
