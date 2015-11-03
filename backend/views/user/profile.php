<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title                   = Yii::t('app', '{modelClass} ', [
        'modelClass' => 'Profile',
    ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Profile'), 'url' => ['update']];
?>
<div class="profile-update">

    <?= $this->render('_profile', [
        'model' => $model,
    ]);?>

</div>
