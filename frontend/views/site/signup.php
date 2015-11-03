<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title                   = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">

    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to signup:</p>

        <div class="row">
            <div class="col-lg-5">
                <?php $form                          = ActiveForm::begin(['id' => 'form-signup']); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?=
                        $form->field(
                            $model, 'first_name', [
                            'template'     => '{label}{input}<i class="fa fa-pencil form-control-feedback"></i>{error}{hint}',
                            'inputOptions' => [
                                'placeholder'  => $model->getAttributeLabel('first_name'),
                                'autocomplete' => 'off',
                            ],
                            'options'      => [
                                'class' => "form-group has-feedback",
                            ],
                            ]
                        )->label($model->getAttributeLabel('first_name'), ['class' => 'control-label']);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?=
                        $form->field(
                            $model, 'last_name', [
                            'template'     => '{label}{input}<i class="fa fa-pencil form-control-feedback"></i>{error}{hint}',
                            'inputOptions' => [
                                'placeholder'  => $model->getAttributeLabel('last_name'),
                                'autocomplete' => 'off',
                            ],
                            'options'      => [
                                'class' => "form-group has-feedback",
                            ],
                            ]
                        )->label($model->getAttributeLabel('last_name'), ['class' => 'control-label']);
                        ?>
                    </div>
                </div>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?=
                $form->field($model, 'rePassword', [
                    'inputOptions' => [
                        'autocomplete' => 'off',
                    ],
                ])->passwordInput()
                ?>
                <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
