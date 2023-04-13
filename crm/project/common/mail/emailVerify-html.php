<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['verify-email', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p>����� ���������� �� ��� ���� <?= Html::encode($user->username) ?>,</p>

    <p>��������� �� ������ ����, ����� ����������� ���� ����������� �����:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
