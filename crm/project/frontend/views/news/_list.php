<?php
use yii\helpers\Html;
use yii\helpers\Url;
use DateTime;
use DateTimeZone;




$time_news = new DateTime($model->created_at);
?>

<div class="new new_offset">
	<a href="<?= Url::to('/news/'.$model->slug) ?>" class="new__img">
		<img class="new__pic" src="<?= Url::to('/uploads/images/'.$model->imageFile) ?>" alt="">
	</a>
	<div class="new__content">
		<span class="date new__date"><?=$time_news->format('d.m.Y');?></span>
		<a href="<?= Url::to('/news/'.$model->slug) ?>" class="new__title">
			<?= $model->title ?>
		</a>
	</div>
</div> 