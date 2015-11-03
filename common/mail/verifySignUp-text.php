<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = \Yii::$app->params['baseUrl'] . '/site/verify?1=' . $user->auth_key;
?>

    Hello,

    Thanks for signing up to <?= \Yii::$app->params['projectName'] ?>

    To complete the sign up process please Click here

    If you are unable to click the above link simply copy and paste the following into your internet browser address bar:

    $verifyLink

    Welcome to <?= \Yii::$app->params['projectName'] ?>!

   	Regards,
    <?= \Yii::$app->params['projectName'] ?>

