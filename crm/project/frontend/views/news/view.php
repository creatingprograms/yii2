<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use backend\modules\forum\models\News;
use DateTime;
use DateTimeZone;
use yii\db\Expression;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$time_news = new DateTime($model->created_at);
?>
        

<main class="main">
	<div class="single">
		<section>
			<div class="wrapper wrapper_small">
				<div class="single-new">

					<div class="single-new__content">
						<div class="wrapper new-wrapper">
							<div class="single-new__nav">
								<a href="/news" class="card-nav__item return-link iconed iconed_center">
									<img class="return-link__ico iconed__ico_r-default" src="/images/return-ico.svg" alt="">
									<span class="iconed__title title title_small">
										Другие новости
									</span>
								</a>
							</div>
							<h1 class="h2 single-new__title"><?=$model->title?></h1>
							<span class="date date_default">
								<?=$time_news->format('d.m.Y');?>
							</span>
							<div class="single-new__desc">
								<?=$model->description?>
							</div>
						</div>
						<div class="video popup-youtube video_offset">
							<?=$model->video?>
						</div>
						<div class="images_news popup-youtube video_offset">
							<img src="/uploads/images/<?=$model->imageFile?>" alt="">
						</div>
						<div class="gallery gallery_offset">
							<div class="row">
							<?php 
							$images = explode(',', $model->allFile);
							foreach($images as $image){ ?>
								<div class="col col--lg-4 col--sm-4 ">
									<a href="/uploads/images/<?=$image?>" class="gallery__item image-popup-trigger">
										<img src="/uploads/images/<?=$image?>" alt="">
									</a>
								</div>
							<?php } ?>
							</div>
						</div>
						<div class="wrapper new-wrapper">
							<div class="paragraph paragraph_middle paragraph_offset">
								<?=$model->text?>
							</div>
							<?php if(!empty($model->docFile)){ ?>
							<div class="new-nav new-nav_offset">
								<div class="row">
									<?php 
									$docs = explode(',', $model->docFile);
									foreach($docs as $doc){ ?>
									<div class="col col--lg-6">
										<a href="/uploads/files/<?=$doc?>" class="box-link box-link_offset">
											<span class="box-link__title"><?=$doc?></span>
											<img class="box-link__ico box-link__ico_download" src="/images/download-ico.svg" alt="">
										</a>
									</div>
									<?php } ?>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<section class="section section_medium">
				<div class="wrapper wrapper_large">
					<h2 class="h2 h2_light in-second__title">Другие новости</h2>
					<div class="row">
						<?php 
							
							//foreach($news as $n){
						if($prevID != '' and $nextID != ''){
						if($prevID != ''){
						$time = new DateTime($prevID->created_at);
						?>
						<div class="col col--md-6">
							<div class="new new_offset">
								<a href="<?=$prevID->slug?>" class="new__img">
									<img class="new__pic" src="/uploads/images/<?=$prevID->imageFile?>" alt="">
								</a>
								<div class="new__content">
									<span class="date new__date"><?=$time->format('Y-m-d');?></span>
									<a href="<?=$prevID->slug?>" class="new__title">
										<?=$prevID->title?>
									</a>
								</div>
							</div>
						</div>
						<?php } 
						if($nextID != ''){ 
						$time1 = new DateTime($nextID->created_at);
						
						?>
						<div class="col col--md-6">
							<div class="new new_offset">
								<a href="<?=$nextID->slug?>" class="new__img">
									<img class="new__pic" src="/uploads/images/<?=$nextID->imageFile?>" alt="">
								</a>
								<div class="new__content">
									<span class="date new__date"><?=$time1->format('Y-m-d');?></span>
									<a href="<?=$nextID->slug?>" class="new__title">
										<?=$nextID->title?>
									</a>
								</div>
							</div>
						</div>
						<?php }}else{ 
						$news2 = News::find()->where(['not', ['id' => $model->id]])->orderBy(new Expression('rand()'))->limit(2)->all();
						foreach($news2 as $new2){
						$time1 = new DateTime($new2->created_at);
						?>
							<div class="col col--md-6">
								<div class="new new_offset">
									<a href="<?=$new2->slug?>" class="new__img">
										<img class="new__pic" src="/uploads/images/<?=$new2->imageFile?>" alt="">
									</a>
									<div class="new__content">
										<span class="date new__date"><?=$time1->format('Y-m-d');?></span>
										<a href="<?=$new2->slug?>" class="new__title">
											<?=$new2->title?>
										</a>
									</div>
								</div>
							</div>
						<?php }} ?>
					</div>
				</div>
			</section>
		</section>
	</div>
</main>
        
