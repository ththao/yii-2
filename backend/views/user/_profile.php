<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="profile-form">

                    <?php
                    $form = ActiveForm::begin([
                            'id'      => 'create-form',
                            'options' => [
                                'class' => 'form-horizontal',
                            ],
                    ]);
                    ?>
                    <?=
                    $form->field($model, 'first_name', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->textInput(['maxlength' => true])->hint('Please enter Fist Name')->label('First Name');
                    ?>

                    <?=
                    $form->field($model, 'last_name', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->textInput(['maxlength' => true])->hint('Please enter Last Name')->label('Last Name');
                    ?>

                    <?=
                    $form->field($model, 'display_name', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->textInput(['maxlength' => true])->hint('Please enter Display Name')->label('Display Name');
                    ?>

                    <?=
                    $form->field($model, 'address', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->textInput(['maxlength' => true])->hint('Please enter Address')->label('Address');
                    ?>

                    <?=
                    $form->field($model, 'address2', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->textInput(['maxlength' => true])->hint('Please enter Address2')->label('Address 2');
                    ?>

                    <?=
                    $form->field($model, 'mobile_number', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->textInput(['maxlength' => true])->hint('Please enter Mobile Number')->label('Mobile Number');
                    ?>

                    <?=
                    $form->field($model, 'city', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->dropDownList(array(''))->label('City');
                    ?>

                    <?=
                    $form->field($model, 'state_id', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->dropDownList(array(''))->label('State');
                    ?>

                    <?=
                    $form->field($model, 'country_id', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => [
                            'class' => 'col-sm-2 control-label',
                        ],
                    ])->dropDownList(array(''))->label('Country');
                    ?>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group col-md-offset-2">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
