<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
?>
<div class="verify-signup">
    <p>Hello,</p>

    <p>Welcome to <?=Yii::$app->params['projectName']?>!</p>

    <p>Your account: </p>
    
    <p>Email: <?= $email; ?></p>
    <p>Password: <?= $password; ?></p>

    <p>
    	Regards,<br/>
    	<?= Yii::$app->params['projectName'] ?>
    </p>
</div>
