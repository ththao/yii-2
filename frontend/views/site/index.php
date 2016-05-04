<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = "Yii2Template";
?>

<div class="col-md-3 left-container">
    <div class="left-item">
        <div class="left-item-title">
            <p>User Login</p>
        </div>
        <div class="left-item-content">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => 'site/login']); ?>
            <?= $form->field($model, 'email'); ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            </div>
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <a href="<?= \yii\helpers\Url::to(['/site/signup']) ?>" class="btn btn-success pull-right" style="color: #FFF; text-decoration: none;">Sign Up</a>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="col-md-9">
    <div class="main">
        <div class="main-title">
            <p>About our service</p>
        </div>
        <div class="main-content">
            <p>Content</p>
        </div>
    </div>
</div>
