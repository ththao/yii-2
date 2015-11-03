<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>

    Hello,

    User <?= $user->getFullname() ?> purchased an account of <?= $account->project->name ?>
    
    Please send account credentials to this email: <?= $user->email ?>

   	Regards,
    <?= \Yii::$app->params['projectName'] ?>

