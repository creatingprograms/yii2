<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\widgets\AdvantageWidget;
use common\widgets\ServicesWidget;

?>
<div class="conteiner" id="content">
	<h1 class="h2 img-header__title">
		<?= $model->title ?>
	</h1>
	<?= $model->description ?>
</div>
<?=ServicesWidget::widget(); ?>