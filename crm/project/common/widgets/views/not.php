<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
?>
    <div class="notices">
        <div class="notices__wrap">
            <ul class="notices__list">
			
				<?php foreach ($nots as $not){ ?>
					<li class="notices__item" not_id="<?=$not->id?>">
						<div class="notices__item-userpic">
							<img class="notices__item-userpic-img" src="/for_admin/img/icons/person.svg" width="24" height="24" alt="Имя">
						</div>

						<div class="notices__item-info">
							<p class="notices__item-desc"><strong><?=$not->title?></strong> - <?=$not->description?></p>
							<?php if($not->document_id){?>
								<a class="doc_down" id="<?=$not->document_id?>" href="/for_admin/document/update?id=<?=$not->document_id?>"><b>Загрузить</b></a>
							<?php } ?>
							<div class="notices__item-time"><?=date('Y-m-d H:m:s', $not->created_at)?></div>
							<?php 
							if(Yii::$app->user->getIdentity()->isUser()){
								?>
								<?= Html::a(
								'Отреагировать',
								['/event', 'notification' => $not->id],
								['class' => 'btn btn--reset btn--logout-before header__popup-item',]
							) ?>
							<?php }?>
						</div>

						<div class="notices__item-close">
							<button class="notices__item-close-btn">x</button>
						</div>
					</li>
				<?php } ?>
            </ul>
        </div>
    </div>