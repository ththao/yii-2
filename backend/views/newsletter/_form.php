<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\switchinput\SwitchBox;
use common\models\Newsletter;
use common\models\Role;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Newsletter */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="news-letter-form">

                    <?php 
                        $form = ActiveForm::begin([
                            'enableAjaxValidation' => true,
                            'id'                   => 'news-letter-' . ($model->isNewRecord ? 'create' : 'update') . '-form',
                            'options'              => [
                            'class' => 'form-horizontal',
                            ],
                        ]); 
                    ?>

                    <?= 
                    $form->field($model, 'subject', [
                        'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                        'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    ])->textInput(['maxlength' => true]) ?>

                    <div class="form-group field-newsletter-content required">
						<div class="form-group">
							<label for="newsletter-content" class="col-sm-2 control-label">Content</label>
							<div class="col-sm-10">
								<div class="col-sm-11">
									<?= $form->field($model, 'content')->widget(CKEditor::className(), [
								        'options' => [
								        	'rows' => 6,
							        		'labelOptions' => ['class' => 'hide'],
								        ],
								        'preset' => 'basic'
								    ])->label(false) ?>
								</div>
							</div>
						</div>
					</div>
                    
					
                    <?= $form->field($model, 'role_id', [
                            'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div></div>',
                            'labelOptions' => ['class' => 'col-sm-2 control-label'],
                        ])->dropDownList(
                                [
                                    Role::ROLE_ADMIN => 'Admin',
                                    Role::ROLE_MEMBER => 'Member',
                                ],           
                                [
                                    'selected' => 'selected', 
                                    'prompt'=>'Select User Type'
                                ]    // options
                            );
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