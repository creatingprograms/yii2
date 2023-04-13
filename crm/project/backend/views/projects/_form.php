<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
	'fieldConfig' => [
		'template' => "{input}{label}{error}",
],
]); ?>
<div class="project-form">
	<?php if(isset($model->title)){ ?>
		<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Название', ['class' => 'input__elem-label']) ?>
	<?php }else{ ?>
		<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Название', ['class' => 'input__elem-label']) ?>
	<?php } ?>
	<?php if(isset($model->title)){ ?>
		<?= $form->field($model, 'number')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('№ Договора', ['class' => 'input__elem-label']) ?>
	<?php }else{ ?>
		<?= $form->field($model, 'number')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('№ Договора', ['class' => 'input__elem-label']) ?>
	<?php } ?>
	<?php if(isset($model->address)){ ?>
		<?= $form->field($model, 'address')->textarea(['rows' => 6, 'class' => 'input__elem has-content'])->label('Адрес', ['class' => 'input__elem-label']) ?>
	<?php }else{ ?>
		<?= $form->field($model, 'address')->textarea(['rows' => 6, 'class' => 'input__elem'])->label('Адрес', ['class' => 'input__elem-label']) ?>
	<?php } ?>
	<?php if(isset($model->area)){ ?>
		<?= $form->field($model, 'area')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Площадь', ['class' => 'input__elem-label']) ?>
	<?php }else{ ?>
		<?= $form->field($model, 'area')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Площадь', ['class' => 'input__elem-label']) ?>
	<?php } ?>
	
	<div class="form__row form__row--two">
		<?php if($users != []){ ?>
			<?= $form->field($model, 'user_id', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Клиент', ['class' => 'input__elem-label'])->dropDownList($users)?>
		<?php } ?>
		<?php if($men != []){ ?>
			<?= $form->field($model, 'manager_id', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Менеджер', ['class' => 'input__elem-label'])->dropDownList($men)?>
		<?php } ?>
		</div>
		<div class="form__row form__row--two">
		<?php /*if($type != []){ 
			echo $form->field($model, 'type', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Тип договора', ['class' => 'input__elem-label'])->dropDownList($type);
		 }*/ if($sts != []){ ?>
			<?= $form->field($model, 'status_id', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Статус', ['class' => 'input__elem-label'])->dropDownList($sts)?>
		<?php } ?>

		</div>
		<?php if(isset($model->description)){ ?>
			<?= $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'input__elem has-content'])->label('Описание', ['class' => 'input__elem-label']) ?>
		<?php }else{ ?>
			<?= $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'input__elem'])->label('Описание', ['class' => 'input__elem-label']) ?>
		<?php } ?>

    <div class="form__send">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn--accent btn--large']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
