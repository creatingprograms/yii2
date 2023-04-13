<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\multiselect\MultiSelect;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
		 'fieldConfig' => [
			'template' => "{input}{label}{error}",
			'options' => [
				'class' => 'input form-group'
			]
		],
		'enableAjaxValidation' => true,
	]); ?>
	<div class="form__row form__row--two">
		<?php if(isset($model->name)){ ?>
			<?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Фамилия', ['class' => 'input__elem-label']) ?>
		<?php }else{ ?>
			<?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Фамилия', ['class' => 'input__elem-label']) ?>
		<?php } ?>
		<?php if(isset($model->name)){ ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Имя', ['class' => 'input__elem-label']) ?>
		<?php }else{ ?>
			<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Имя', ['class' => 'input__elem-label']) ?>
		<?php } ?>
	</div>	
	

	<div class="form__row form__row--two">	
		<?php if(isset($model->name)){ ?>
			<?= $form->field($model, 'patronymic')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Отчество', ['class' => 'input__elem-label']) ?>
		<?php }else{ ?>
			<?= $form->field($model, 'patronymic')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Отчество', ['class' => 'input__elem-label']) ?>
		<?php } ?>
	        <?= $form->field($model, 'patronymic_status')->checkbox(['uncheck'=>'Yes', 'value'=>'No', 'class' => 'input__elem'])->label('Отчества нет', ['class' => 'input__elem-label']) ?>
	</div>
	
	
	
	
	
	<div class="form__row form__row--two">
		<?php if(isset($model->email)){ ?>
			<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'input__elem has-content', 'type' => 'email'])->label('Почта', ['class' => 'input__elem-label']) ?>
		<?php }else{ ?>
			<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'input__elem', 'type' => 'email'])->label('Почта', ['class' => 'input__elem-label']) ?>
		<?php } ?>
		<?php if(isset($model->phone)){ ?>
			<?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'input__elem has-content', 'type' => 'phone'])->label('Телефон', ['class' => 'input__elem-label']) ?>
		<?php }else{ ?>
			<?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'input__elem', 'type' => 'phone'])->label('Телефон', ['class' => 'input__elem-label']) ?>
		<?php } ?>
	</div>
	<div class="form__row form__row--two <?= $get_r == '5' ? 'd-none' : ''?> <?= $get_r == '2' ? 'd-none' : ''?>">
	<div class="d-none">
	<?php if($get_r > 0){ ?>
			<?= $form->field($model, 'role', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Выберите пользователя', ['class' => 'input__elem-label'])->dropDownList($role, ['value' => $get_r])?>
	<?php }elseif(isset($role)){ ?>
			<?= $form->field($model, 'role', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Выберите пользователя', ['class' => 'input__elem-label'])->dropDownList($role, ['value' => 1])?> 
	<?php } ?>
	</div>
	<?php if(isset($type)){ ?>
			<?= $form->field($model, 'type', ['inputOptions'=> ['class' => 'select-styled input__elem has-content']])->label('Тип пользователя', ['class' => 'input__elem-label'])->dropDownList($type, ['options'=>[$model->type]])?>
		
	<?php } ?>
	</div>
	<div class="type_block ur_input <?=$model->type == "2" ? '' : 'd-none'?>">
		<div class="form__row form__row--two">
			<?php if(isset($model->ogrn)){ ?>
				<?= $form->field($model, 'ogrn')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('ОГРН', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'ogrn')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('ОГРН', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->inn)){ ?>
				<?= $form->field($model, 'inn')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('ИНН', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'inn')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('ИНН', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
		<div class="form__row form__row--two">
			<?php if(isset($model->rs)){ ?>
				<?= $form->field($model, 'rs')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Расчетный счет', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'rs')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Расчетный счет', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->ks)){ ?>
				<?= $form->field($model, 'ks')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Кор. счет', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'ks')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Кор. счет', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
		<div class="form__row form__row--two">
			<?php if(isset($model->bik)){ ?>
				<?= $form->field($model, 'bik')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('БИК', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'bik')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('БИК', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->bank)){ ?>
				<?= $form->field($model, 'bank')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Банк', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'bank')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Банк', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
		<div class="form__row form__row--two">
			<?php if(isset($model->ur_name)){ ?>
				<?= $form->field($model, 'ur_name')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Наименование Юрлица', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'ur_name')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Наименование Юрлица', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->ur_address)){ ?>
				<?= $form->field($model, 'ur_address')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Юр. адрес', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'ur_address')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Юр. адрес', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
	</div>
	
	<div class="type_block fis_input <?=$model->type != "2" ? '' : 'd-none'?>  <?= $get_r == '5' ? 'd-none' : ''?> <?= $get_r == '2' ? 'd-none' : ''?>">
		<div class="form__row form__row--two">
			<?php if(isset($model->fis_passport)){ ?>
				<?= $form->field($model, 'fis_passport')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Cерия/номер паспорт', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'fis_passport')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Cерия/номер паспорт', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->fis_vidan)){ ?>
				<?= $form->field($model, 'fis_vidan')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Кем/когда выдан', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'fis_vidan')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Кем/когда выдан', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
		<div class="form__row form__row--two">
			<?php if(isset($model->fis_number)){ ?>
				<?= $form->field($model, 'fis_number')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Код подразделения', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'fis_number')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Код подразделения', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->fis_registration)){ ?>
				<?= $form->field($model, 'fis_registration')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Прописка', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'fis_registration')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Прописка', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
	</div>
	
	
	<h3 class="form__subtitle">Связанные проекты</h3>

		<?php if(!Yii::$app->user->getIdentity()->isUser()){
		if($projects != []){ ?>
			<?= $form->field($model, 'projects', ['inputOptions'=> ['class' => 'select-styled']])->label(false)->dropDownList($projects)?>
	<?php
		}}
	if(!empty($project_for)){
		$i_for = 0;
		$count_for = count($project_for);
		foreach($project_for as $pr){
			$i_for++;
		?>
			<div class="input">
				<div class="input__nav">
					<input type="text" name="modal-select-1" value="<?=$pr->title?>" project="<?=$pr->id?>" class="input__elem">
					<div class="input__btns">
						<button class="btn btn--light input--btn input--btn-edit" aria-label="Edit input"></button>
						<?php if($i_for==$count_for){ ?>
							<button class="btn btn--light input--btn input--btn-add" aria-label="Add input"></button>
						<?php } ?>
						<button class="btn btn--light input--btn input--btn-delete" aria-label="Remove input"></button>
					</div>
				</div>
			</div>
		
		<?php }} else {
			echo "<p>В данный момент у вас нет проектов по которым ведутся работы.</p>";
		}
	if(!empty($project_men)){
		$i_men = 0;
		$count_men = count($project_men);
		foreach($project_men as $pr){
			$i_men++;
		?>
			<div class="input">
				<div class="input__nav">
					<input type="text" name="modal-select-1" value="<?=$pr->title?>" class="input__elem">
					<div class="input__btns">
						<button class="btn btn--light input--btn input--btn-edit" aria-label="Edit input"></button>
						<?php if($i_men==$count_men){ ?>
							<button class="btn btn--light input--btn input--btn-add" aria-label="Add input"></button>
						<?php } ?>
						<button class="btn btn--light input--btn input--btn-delete" aria-label="Remove input"></button>
					</div>
				</div>
			</div>
		
		
		<?php }} ?>

	<div class="input">
		<?= $form->field($model, 'password', [
			  'options' => [
				 'class' => 'input__nav'
			   ]])->textInput(['maxlength' => true, 'class' => 'input__elem', 'placeholder' => 'Введите или сгенерируйте пароль'])
			   ->label(false) ?>
			<div class="input__btns pass_btns">
				<button class="btn btn--light input--btn input--btn-refresh" aria-label="Refresh input"></button>
				<button class="btn btn--light input--btn input--btn-delete" aria-label="Remove input"></button>
			</div>
			<div class="input__desc">Если вы измените это поле, пароль пользователя будет изменен</div>
	</div>
	<?php if(!Yii::$app->user->getIdentity()->isUser()){ ?>
	<div class="input input--status">
		<div class="input--status__title">Учетная запись пользователя</div>

		<div class="input--status__right">
			<?= $form->field($model, 'active', [
				  'options' => [
					 'class' => 'switch'
				   ]])->checkbox(['label' => null]) ?>
			<p class="is_active"><?=$model->active==1 ? 'Активный' : 'Не активный'?></p>
		</div>
	</div>
	<?php } 
	if(Yii::$app->user->getIdentity()->isUser()){ ?>
		<!--<div class="form__row form__row--two">
			<?php if(isset($model->ogrn)){ ?>
				<?= $form->field($model, 'ogrn')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('ОГРН', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'ogrn')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('ОГРН', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->inn)){ ?>
				<?= $form->field($model, 'inn')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('ИНН', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'inn')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('ИНН', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
		<div class="form__row form__row--two">
			<?php if(isset($model->rs)){ ?>
				<?= $form->field($model, 'rs')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Расчетный счет', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'rs')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Расчетный счет', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->ks)){ ?>
				<?= $form->field($model, 'ks')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Кор. счет', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'ks')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Кор. счет', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
		<div class="form__row form__row--two">
			<?php if(isset($model->bik)){ ?>
				<?= $form->field($model, 'bik')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('БИК', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'bik')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('БИК', ['class' => 'input__elem-label']) ?>
			<?php } ?>
			<?php if(isset($model->bank)){ ?>
				<?= $form->field($model, 'bank')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Банк', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'bank')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Банк', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>
		<div class="form__row form__row--two">
			<?php if(isset($model->ur_address)){ ?>
				<?= $form->field($model, 'ur_address')->textInput(['maxlength' => true, 'class' => 'input__elem has-content'])->label('Юр. адрес', ['class' => 'input__elem-label']) ?>
			<?php }else{ ?>
				<?= $form->field($model, 'ur_address')->textInput(['maxlength' => true, 'class' => 'input__elem'])->label('Юр. адрес', ['class' => 'input__elem-label']) ?>
			<?php } ?>
		</div>-->
	<?php } ?>

    <div class="form__send">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn--accent btn--large']) ?>
    </div>

    <?php ActiveForm::end(); ?>
