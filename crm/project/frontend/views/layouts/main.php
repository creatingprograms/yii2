<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use backend\models\Settings;
use backend\models\Staticpage;
use backend\modules\forum\models\Infoblock;
use backend\modules\forum\models\InfoblockItem;
use backend\models\Menuitem;
use backend\models\Menu;
use backend\models\Contacts;
use backend\modules\catalog\models\StoreProducer;
use backend\modules\catalog\models\StoreCategory;
use common\widgets\SliderWidget;
use common\widgets\CooperationWidget;
use common\widgets\ServiceWidget;
use common\widgets\CalculatorWidget;
use common\widgets\ProductionWidget;
use common\widgets\ReviewWidget;
use common\widgets\ServicesWidget;
use common\widgets\RentWidget;

AppAsset::register($this);
?>
<?php $this->beginPage(); 

$settings = Settings::find()->all();
$model = Staticpage::find()->where(['slug'=>'home'])->one();
$menu = Menu::find()->where(['code'=>'top-menu'])->where(['status'=>'1'])->one();
!empty($menu)? $menuItems = Menuitem::find()->where(['menu_id'=>$menu->id])->where(['parent_id'=>'0'])->orderBy('sort')->all():'';
$collection = StoreProducer::find()->all();
$category = StoreCategory::find()->all();
    
$phone = Contacts::find()->where(['param_name'=>'phone'])->one();
$address = Contacts::find()->where(['param_name'=>'address'])->one()->param_value;
$email = Contacts::find()->where(['param_name'=>'email'])->one();
$ooo = Contacts::find()->where(['param_name'=>'ooo'])->one()->param_value;
$email_sales = Contacts::find()->where(['param_name'=>'emailSales'])->one();
$social = Contacts::find()->where(['param_name'=>'social'])->all();
$whatsapp = Contacts::find()->where(['param_name'=>'whatsapp'])->one();
        
        
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php foreach ($settings as $m){
        $m->param_name == 'indexation'? $indexation = $m->param_value: $indexation = '';
        if($indexation =='2'){ ?>
                <meta name="robots" content="noindex, nofollow"/>
    <?php }} ?>
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?php if(Yii::$app->request->url == Yii::$app->homeUrl){ ?>
    <title><?php
        foreach ($settings as $m){
            if($m->param_name == 'siteName'){ $siteName = $m->param_value; };
        }
        echo $siteName? $siteName : $this->title;?></title>
    <?php
    foreach ($settings as $m){ ?>
        <?php if($m->param_name == 'siteKeyWords'){ ?>
            <meta name="keywords" content="<?= $m->param_value ?>"><?php }}?>
    <?php
    foreach ($settings as $m){ ?>
        <?php if($m->param_name == 'siteDescription'){ ?> 
    <meta name="description" content="<?= $m->param_value ?>"><?php }}}else{?>
	<title><?= Html::encode($this->title) ?></title>
	<?php } ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
 <div class="header_back">
    <div class="conteiner header">
                <a href="#" id="openMenu">
                    <span class="lineOp" id="line1"></span>
                    <span class="lineOp" id="line2"></span>
                    <span class="lineOp" id="line3"></span>
		</a>
           <ul class="head_menu" id="nainMenu">
                   <?php 
                   if(!empty($menu)) {
                   $k=1;
                   foreach ($menuItems as $menuItem){
                           $childrens = Menuitem::find()->where(['menu_id'=>$menu->id])->where(['parent_id'=>$menuItem->id])->orderBy('sort')->all();
                           if($childrens != []){
                           ?>
                           <li class="l_1">
                                   <a class="root-item" href="<?=$menuItem->href?>"><?=$menuItem->title?></a>
                                   <ul class="ul_1">
                                           <?php foreach ($childrens as $children){ ?>
                                                           <li><a href="<?=$children->href?>"><?=$children->title?></a></li>
                                           <?php } ?>
                                   </ul>
                           </li>
                   <?php
                   $k++;
                   } else { ?>
                   <li class="<?php if($menuItem->title == 'Акции и распродажа'){ ?> stock<?php } ?>"><a href="<?=$menuItem->href?>" class="root-item"><?=$menuItem->title?></a></li>
           <?php }}} ?>
           </ul>
        <div class="contacts">
           <div class = "contact">
                <a href="<?=$email->param_link?>" class="mail"><?=$email->param_value?></a>
           </div>
        </div>
   </div>
</div>
<div class="header_contact" <?php if(Yii::$app->request->url == Yii::$app->homeUrl){ ?>
    style="box-shadow:none;"
    <?php }?>>
    <div class="conteiner">
        <a class="logo" href="/"><img class="logo__pic" src="/uploads/images/default/<?php foreach ($settings as $m){
            if($m->param_name == 'logo'){ echo $m->param_value; }}?>"></a>
        <div class="opis"><?php
        foreach ($settings as $m){
            if($m->param_name == 'siteName'){ $siteName = $m->param_value; };
        }
        echo $siteName? $siteName : $this->title;?> </div>
         <a class="phone" href="<?=$phone->param_link?>"><img class="icon_phone" src="/uploads/images/default/<?=$phone->param_icon?>"><?=$phone->param_value?></a>
        <a class="button2" href="http://geo-cadastr.ru/#service">Перезвоните мне</a>
    </div>
</div>
<?php if(Yii::$app->request->url == Yii::$app->homeUrl): 
echo SliderWidget::widget();
echo ServiceWidget::widget();
echo ReviewWidget::widget();
// echo CalculatorWidget::widget();
?>
<?=RentWidget::widget(); ?>
<?=ProductionWidget::widget(); ?>
<?=ServicesWidget::widget(); ?>
<?php //CooperationWidget::widget(); ?>
	
    <?php
    else:
        if ((Yii::$app->controller->id == 'site') and (Yii::$app->controller->action->id == 'index')) { 
     echo $content; } else { ?>

    <div class="breadcrumbs">
        <div class="conteiner">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'class' => 's-breadcrumb-list',
            ]) ?>
            <?= Alert::widget() ?>
        </div>
    </div>
    <?= $content ?>
    <?php }; endif;?>
    
<div class="footer">
	<div class="conteiner">
            <div class="left">
                <a class="logo" href="/"><img class="logo__pic" src="/uploads/images/default/<?php foreach ($settings as $m){
                    if($m->param_name == 'logo'){ echo $m->param_value; }}?>"></a>
                    <p><?php
                    foreach ($settings as $m){
                        if($m->param_name == 'siteName'){ $siteName = $m->param_value; };
                    }
                    echo $siteName? $siteName : $this->title;?></p>
                    <div class="phone"><img class="icon_phone" src="/uploads/images/default/<?=$phone->param_icon?>"><?=$phone->param_value?></div>
                    <div class="mail"><img class="icon_phone" src="/uploads/images/default/<?=$email->param_icon?>"><?=$email->param_value?></div>
                    <div class = "social">
                        <?php foreach($social as $s){ ?>
                        <a href="https://<?=$s->param_link?>" target="_blank"><img src="/uploads/images/default/<?=$s->param_icon?>"></a>
                        <?php } ?>
                    </div>
            </div>
            <div class="center">
				<?php $info = Infoblock::find()->where(['id'=>7])->one();
					 echo InfoblockItem::find()->where(['infoblock_id'=>$info->id])->one()->description; ?>
            </div>
            <div class="right">
					<?php echo InfoblockItem::find()->where(['infoblock_id'=>$info->id])->offset(1)->one()->description; ?>
            </div>
            <div class = "address">
                <div class="teg"><?=$ooo?></div>
                <div class="teg"><a href="/confidentiality">Политика конфиденциальности</a></div>
                <div class="teg">Создание сайта: <a href="https://vk.com/shreifer" target="_blank">Vk.com</a></div>
            </div>
            <!--<a id="effectis" href="https://vk.com/shreifer" target="_blank">Переработка сайта: —  </a>-->
	</div>
</div>
<div id="BoxBg"></div>
<div id="callBox">
	<a href="#" id="closeForm"></a>
	<div id="call">
		<form method="post" id="callForm">	
		<div class="titleBig">ОН-ЛАЙН ЗАЯВКА</div>
		    <input type="hidden" name="URL">
			<input type="text" placeholder="Имя" name="name" required>
			<input type="text" placeholder="Компания" name="company">
			<input type="tel" placeholder="Номер телефона" name="tel" required>
			<input type="email" required placeholder="Эл. почта" name="email">
			<textarea name="body" id="txt" cols="30" rows="2" placeholder="Сообщение"></textarea>
			<div class="clear"></div>
			<input type="submit" value="Отправить">
		</form>
	</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
