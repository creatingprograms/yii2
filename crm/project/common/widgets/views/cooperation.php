<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Contacts;
use yii\bootstrap\ActiveForm;
?>
<div id="contactBox">
	<div id="contacttitle"><?=$info->title?></div>
	<div id="icoMes"><img src="/uploads/images/<?=$info->imageFile?>" title="Месенджеры" alt="Месенджеры" width="144" height="37"><br></div>
	<div id="contatPhone">
		<a href="<?=Contacts::find()->where(['param_name'=>'phone'])->one()->param_link?>">
			тел:<?=Contacts::find()->where(['param_name'=>'phone'])->one()->param_value?>
		</a>
	</div>
	<div id="contactAddress">Адрес: <?=Contacts::find()->where(['param_name'=>'address'])->one()->param_value?><br></div>
	<div id="contactEmail">
		<a href="mailto:<?=Contacts::find()->where(['param_name'=>'email'])->one()->param_value?>">
			<?=Contacts::find()->where(['param_name'=>'email'])->one()->param_value?>
		</a>
	</div>
</div>
<div id="mapBox">
	<div class="bx-yandex-view-layout">
		<div class="bx-yandex-view-map">
			<div id="BX_YMAP_MAP_mF8Ev4" class="bx-yandex-map" style="height: 500px; width: 100%;"><?=$info->description?></div>
		</div>
	</div>
	<br>
</div>