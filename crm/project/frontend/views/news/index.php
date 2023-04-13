<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;
?>
        
<main class="main">
	<div class="single">
		<div class="wrapper wrapper_large">
			<h1 class="h2 single__title">
				<?= Html::encode($this->title) ?>
			</h1>
		</div>
		<section>
			<div class="wrapper wrapper_large">
				<?php
					echo ListView::widget([
						'dataProvider' => $dataProvider,
						'itemView' => '_list',
						'options' => [
							'tag' => 'div',
							'class' => 'row',
						],
						'layout' => "{items}\n{pager}",
						
						'itemOptions' => [
							'tag' => 'div',
							'class' => 'col col--md-6',
						], 
						'pager' => [
							'nextPageLabel'=>'',
							'prevPageLabel'=>'',    
							'maxButtonCount' => 5,
						],
					]); ?>
				<!--<div class="row">
					<div class="col col--lg-12">
						<div class="btn-wrapper btn-wrapper_centered">
							<div class="circle-macro__wrapper">
								<a href="#" class="circle circle_macro circle_blue">
									<span class="circle__text">
										Загрузить<br> ещё
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>-->
		</div>
	</section>
</div>
</main>
        
