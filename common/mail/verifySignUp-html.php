<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = \Yii::$app->params['baseUrl'] . '/site/verify?1=' . $user->auth_key;
?>
<div class="verify-signup">
    <p>Hello,</p>

    <p>Thanks for signing up to <?= \Yii::$app->params['projectName'] ?>.</p>

    <p>To complete the sign up process please click <?= Html::a(Html::encode('here'), $verifyLink) ?></p>

    <p>If you are unable to click the above link simply copy and paste the following into your internet browser address bar:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>

    <p>Welcome to <?= \Yii::$app->params['projectName'] ?>!</p>

    <p>
    	Regards,<br/>
    	<?= \Yii::$app->params['projectName'] ?>
    </p>
</div>
