<?php



use yii\helpers\Html;



?>

	<div class="humble humble--date"><?=date('D, d M, Y', $model->created_at)?></div>

	<div class="calendar-modal__col">

		<div class="calendar-modal__col-title">

		<?=$model->title?>

			<p>Проект: <?= !empty($project) ? $project->title : ''?></p>

		</div>

		<div class="btns-spacer">

			<?php 

			//var_dump();die(!empty($document));

			if(Yii::$app->user->getIdentity()->isUser() || Yii::$app->user->getIdentity()->isSub() && !empty($document)){

				 if(is_object($document) && $document->type_id != 10){

					echo Html::a(

									'Загрузить файл',

									['document/update?id='.$document->id],

				['class' => 'btn btn-success doc_down', 'id' => $document->id]);

					

				}}

				?>

		
            <?php if($model->status != "1" && $model->type == "1"){ ?>

            <div class="btn btn--accent">Не Согласовано</div>

            <?php } else { ?>
			
            <div class="btn btn--accent btn--check">Cогласовано</div>

            <?php } ?>

		</div>

	</div>

	<div class="calendar-modal__col">

		<div class="calendar-modal__col-title"><?=$model->description?></div>

		<div class="btns-spacer">

			<?php //Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn--border btn--views'])

				//Html::a(

				//'Просмотр',

				//['/event/view'],

				//['class' => 'btn btn--border btn--views', 'id' => $model->id, 'act' => 0]

			//) 

			?>

			<!--<div class="btn btn--border btn--check">Согласовать</div>-->

            <?php if(Yii::$app->user->getIdentity()->isUser() && !empty($not)){ ?>

                <?php /*Html::a(

                    'Согласовать',

                    ['/notification/matching'],

                    ['class' => 'btn btn-success act_matching', 'id' => $not->id, 'act' => 0]

                )*/ ?>

                <?= Html::a(

                    'Подтвердить',

                    ['/notification/matching'],

                    ['class' => 'btn btn--border btn--check act_matching', 'id' => $not->id, 'act' => 1]

                ) ?>

                <?= Html::a(

                    'Не согласовать',

                    ['/notification/matching'],

                    ['class' => 'btn btn--border not--accepted']

                ) ?>

            <?php } ?>

		</div>

	</div>

    <?php if(Yii::$app->user->getIdentity()->isUser() && !empty($not)){ ?>
        <div class="not--accepted--reason d-none">
            <textarea id="comment--not--accepted" class="form-control"></textarea>
            <div class="text-right">
                <?= Html::a(

                'Отправить',

                ['/notification/matching'],

                ['class' => 'btn btn--border act_matching_with_comment', 'id' => $not->id, 'act' => 3]

                ) ?>
            </div>
        </div>
    <?php } ?>