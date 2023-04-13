<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
			[
				'attribute' => 'status',
				'format' => 'raw',
				'value' => function ($model, $key) {
					$type = ['10' => 'Ожидает звонка', '2' => 'Пошел спать'];
					return \yii\helpers\Html::tag(
						'span',
						$model->status != 0 ? $type[$model->status] : 'Статус не выбран',
						[
							'class' => '',
						]
					);
				},
			],
			[
				'attribute' => 'created_at',
				'value' => function ($data) {
					 return !empty($data->created_at) ? date('d-m-Y', $data->created_at) : '';
				},
			],
			[
				'attribute' => 'updated_at',
				'value' => function ($data) {
					 return !empty($data->updated_at) ? date('d-m-Y', $data->updated_at) : '';
				},
			],
            //'verification_token',
            'name',
            'surname',
            'patronymic',
            'phone',
			[
				'attribute' => 'active',
				'format' => 'raw',
				'value' => function ($model, $key) {
					$status = ['1' => 'Да', '0' => 'Нет'];
					return \yii\helpers\Html::tag(
						'span',
						$status[$model->active],
						[
							'class' => '',
						]
					);
				},
			],
        ],
    ]) ?>

</div>
