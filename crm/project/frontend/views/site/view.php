<?php

use common\widgets\SliderWidget;

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

            <p class="lead"><?=$model->description?></p>
        </div>

        <div class="body-content">
            <?= date('Y-m-d H:i:s', time())?>
            <div class="row">
                <div class="col-lg-4">
                    <img src="/uploads/images/<?=$model->imageFile?>" />
                </div>
                <div class="col-lg-8">
                    <p><?=$action?></p>

                    <p><a class="btn btn-default" href="#">Yii Documentation &raquo;</a></p>
                </div>
            </div>

        </div>
    </div>
</div>
