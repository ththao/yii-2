<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NewsLetter */

$this->title = Yii::t('app', 'Create Newsletter');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsletters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-letter-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
