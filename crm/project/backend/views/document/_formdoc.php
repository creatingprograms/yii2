<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Document */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin([
	'fieldConfig' => [
		'template' => "{input}{label}{error}"
	],
	'options' => [
		'class' => "load-file__form form"
	],
]); ?>
<div class="form__footer">
	<div class="input m-0">
		<?= $form->field($model, 'upload_doc')->label('Загрузить файл', ['class' => 'input__file-label'])->fileInput(); ?>
	</div>
	<div class="form__send">
		<?= Html::submitButton('Отправить', ['class' => 'btn btn--accent']) ?>
	</div>

</div>

    <?php ActiveForm::end(); ?>