<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title                   = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="login-box-msg">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Please fill out the following fields to login:
        </p>
    </div>


    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => ""]]); ?>
    <?=
    $form->field($model, 'email', [
        'template'     => '{label}{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span>{error}{hint}',
        'inputOptions' => [
            'placeholder' => 'Email'
        ],
        'options'      => [
            'class' => "has-feedback",
        ],
        ]
    )->label(false);
    ?>
    <?=
    $form->field($model, 'password', [
        'inputOptions' => [
            'placeholder' => 'Password'
        ],
        'options'      => [
            'class' => "has-feedback",
        ],
        'template'     => '{label}{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>{error}{hint}'
    ])->passwordInput()->label(false);
    ?>
    <div class="row">
        <div class="col-xs-8">
            <?= $form->field($model, 'rememberMe')->checkbox() ?>

        </div><!-- /.col -->
        <div class="col-xs-4">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
        </div><!-- /.col -->
    </div>
    <?php ActiveForm::end(); ?>
</div>
