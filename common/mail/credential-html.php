<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="verify-signup">
    <p>Hello,</p>
	
    <p>User <?= $user->getFullname() ?> purchased an account of <?= $account->project->name ?></p>
	
	<p>Please send account credentials to this email: <?= $user->email ?></p>
	
    <p>
    	Regards,<br/>
    	<?= \Yii::$app->params['projectName'] ?>
    </p>
</div>
