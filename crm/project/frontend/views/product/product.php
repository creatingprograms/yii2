<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

if(!empty($settings)){
    foreach ($settings as $m){
        $m->param_name == 'logo'? $logo = $m->param_value: $logo = '';
        $m->param_name == 'siteName'? $siteName = $m->param_value: $siteName = '';
        $m->param_name == 'siteDescription'? $siteDescription = $m->param_value: $siteDescription = '';
        $m->param_name == 'siteKeyWords'? $siteKeyWords = $m->param_value: $siteKeyWords = '';
        $m->param_name == 'email'? $email = $m->param_value: $email = '';
        $m->param_name == 'indexation'? $indexation = $m->param_value: $indexation = '';
    }
}
$this->title = $siteName;
?>
<div class="container">
    <div class="site-index">

        <div class="jumbotron">
            <h1><?=$model->title?></h1>
        </div>
<?php if(empty($records)){ ?>
            <p>На данный момент в этой категории записей нет.</p>
<?php }else{ ?>
        <div class="body-content">
            <div class="row">
                <?php foreach ($records as $m){ ?>

                <div class="col-lg-4">
                    <h2><?=$m->title?></h2>

                    <img src="/uploads/images/<?=$m->imageFile?>" />
                    <?= Html::a('Подробнее &raquo;', Url::to(['store/view', 'slug'=>$m->slug]),['class'=> 'btn btn-default'])   ?>
                    </p>
                </div>

               <?php } ?>
            </div>

        </div>
<?php } ?>
    </div>
</div>
