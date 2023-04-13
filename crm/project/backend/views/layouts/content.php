<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use \Yii as Y;

$ca = Y::$app->controller->id.Y::$app->controller->action->id;
?>
<?php if($ca=='documentupdate' && Yii::$app->user->isGuest){ ?>
<div class="main-block-center"><?php }else{?>
<div class="main-block"><?php } ?>
	<div class="data-table">
		<?= Alert::widget() ?>
		<?= $content ?>
	</div>
</div>
