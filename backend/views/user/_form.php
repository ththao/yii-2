<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\switchinput\SwitchBox;
use yii\helpers\ArrayHelper;
use common\models\Role;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="user-form">
                    <?php
                    $form = ActiveForm::begin([
                            'id'                   => 'create-form',
                            'enableAjaxValidation' => true,
                            'options'              => [
                                'class' => 'form-horizontal',
                            ],
                    ]);
                    ?>

                    <?=
                    $form->field($model, 'username', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->textInput()->label('User Name');
                    ?>

                    <?=
                    $form->field($model, 'email', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->input('email')->label('Email');
                    ?>

                    <?=
                    $form->field($model, 'role_id', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->dropDownList(ArrayHelper::map(Role::find()->all(), 'id', 'name'))->label('Role');
                    ?>

                    <?=
                    $form->field($model, 'status', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->widget(SwitchBox::className(), [
                        'options'       => [
                            'label' => false,
                        ],
                        'clientOptions' => [
                            'size'     => 'normal',
                            'onColor'  => 'success',
                            'offColor' => 'danger'
                        ]
                    ])->hint('Turn on/off user');
                    ?>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-offset-2">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>