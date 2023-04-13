<?php
use yii\helpers\Html;
use common\widgets\NotWidget;
use backend\models\Notification;
use backend\models\Settings;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<?php
 if(!Yii::$app->user->isGuest){
$settings = Settings::find()->all();
 ?>
<div class="header">
	<div class="container">
		<div class="header__row">
                <button class="btn btn--light btn--burger header__burger" aria-label="mobile menu" data-toggle="push-menu" ></button>
                <a href="/" class="header__logo">
                    <img class="header__logo-img" src="/uploads/images/default/<?php foreach ($settings as $m){
            if($m->param_name == 'logo'){ echo $m->param_value; }}?>" width="132" height="29" alt="Logo">
                </a>
                <div class="header__panel">
                    <div class="header__panel-col">
                        <button href="#person" class="btn btn--light btn--person header__person" title="Личный кабинет">
                            <img class="header__person-img" src="/for_admin/img/icons/person.svg" width="24" height="24" alt="Имя">
                        </button>

                        <div class="header__popup">
                            <a href="/for_admin/user/lk" class="btn btn--reset btn--user-before header__popup-item">Личный кабинет</a>
                            <?= Html::a(
                                'Выйти',
                                ['/site/logout'],
                                ['data-method' => 'post', 'class' => 'btn btn--reset btn--logout-before header__popup-item',]
                            ) ?>
                        </div>
                    </div>

                    <button class="btn btn--light btn--notice" aria-label="View notice">
					<?php
						if (Yii::$app->user->getIdentity()->isAdmin()){
							$nots = Notification::find()->where(['status_ad'=>1])->all();
						}else if(Yii::$app->user->getIdentity()->isManager()){
							$nots = Notification::find()->where(['status_men'=>1])->andWhere(['manager_id' => Yii::$app->user->id])->all();
						}else if(Yii::$app->user->getIdentity()->isUser()){
							$nots = Notification::find()->where(['status_us'=>1])->andWhere(['user_id' => Yii::$app->user->id])->all();
						}else if(Yii::$app->user->getIdentity()->isSub()){
							$nots = Notification::find()->where(['status_sub'=>1])->andWhere(['sub_id' => Yii::$app->user->id])->all();
						} ?>
                        <div class="count"><?=count($nots)?></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?= NotWidget::widget() ?>
 <?php } ?>