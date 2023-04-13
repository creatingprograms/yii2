<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pageblock */

$this->title = 'Create Pageblock';
$this->params['breadcrumbs'][] = ['label' => 'Pageblocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pageblock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
