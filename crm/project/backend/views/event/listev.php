<?php

use yii\helpers\Html;

?>
	<div class="humble humble--date event_date_data"><?=$date?></div>
<div class="calendar-modal__col-title">
	Список событий:
	
	<?php 
	if(!empty($events)){
	foreach($events as $ev){ ?>
		<p><?=Html::a($ev->title, ['event/view?id='.$ev->id], ['class' => 'view_event', 'id' => $ev->id])?><?=Html::a('', ['event/delete?id='.$ev->id], ['class' => 'delete', 'id' => $ev->id])?></p>
	<?php }}else{ ?>
		<p>Событий на выбранную дату нет</p>
	<?php } 
	if(!Yii::$app->user->getIdentity()->isUser()){
	?>
	<p><?= Html::a('Создать событие', ['event/create?'], ['class' => 'btn btn-success add_event'])?></p>
	<?php } ?>
</div>