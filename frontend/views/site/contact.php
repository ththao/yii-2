<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title                   = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">

    <div class="site-contact">
        <div class="row">
            <div class="col-md-5">
                <h3>We'd Love to Hear From You</h3>
                <!--<h4 class="heading-mini"></h4>-->
                <p><b>Telephone:</b> +84 907996110</p>
                <p >
                    <b>Business Address:</b> Ho Chi Minh, Vietnam
                </p>
            </div>

            <div class="col-md-6 col-md-offset-1">
                <h3><?= Html::encode($this->title) ?></h3>

                <p>
                    If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
                </p>
                <?php $form                          = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?=
                        $form->field(
                            $model, 'name', [
                            'template'     => '{label}{input}{error}{hint}',
                            'inputOptions' => [
                                'autocomplete' => 'off',
                            ],
                            'options'      => [
                                'class' => "form-group has-feedback",
                            ],
                            ]
                        )->label($model->getAttributeLabel('name'), ['class' => 'control-label']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?=
                        $form->field(
                            $model, 'email', [
                            'template'     => '{label}{input}{error}{hint}',
                            'inputOptions' => [
                                'autocomplete' => 'off',
                            ],
                            'options'      => [
                                'class' => "form-group has-feedback",
                            ],
                            ]
                        )->label($model->getAttributeLabel('email'), ['class' => 'control-label']);
                        ?>
                    </div>
                </div>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'type')
                    ->dropDownList(
                      $model->getType(),         
                    ['prompt'=>'Select Type']    
                ); ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?=
                $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])
                ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
