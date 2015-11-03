<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsLetter */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Newsletter',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsletters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="news-letter-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
