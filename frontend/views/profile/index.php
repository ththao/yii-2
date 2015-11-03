<?php
/* @var $this yii\web\View */
/* @var $projects array */
use common\models\Project;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Country;
?>
<div class="box box-warning box-solid" style="margin-top: 9px;">
	<div class="box-header">
		<h3 class="box-title">My Information</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<br />
		<br />
		<div data-example-id="togglable-tabs"
			class="bs-example bs-example-tabs">
			<ul role="tablist" class="nav nav-tabs" id="myTabs">
				<li class="active" role="presentation"><a aria-expanded="true"
					aria-controls="update-profile" data-toggle="tab" role="tab"
					id="update-profile-tab" href="#update-profile">Update Profile</a></li>
				<li role="presentation" class=""><a aria-controls="change-password"
					data-toggle="tab" id="change-password-tab" role="tab"
					href="#change-password" aria-expanded="false">Change Password</a></li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div aria-labelledby="update-profile-tab" id="update-profile"
					class="tab-pane fade active in" role="tabpanel">
					<br />
          <?php
            $form = ActiveForm::begin([
              'id' => 'update-profile-form',
              'options' => ['class' => 'form-horizontal'],
              'action'  => ['profile/update']
            ]);
            
            echo $form->field($profile, 'first_name', [
                'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{hint}{error}</div></div></div>',
                'labelOptions' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ])->textInput(['maxlength' => true]);
                
            echo $form->field($profile, 'last_name', [
                'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{hint}{error}</div></div></div>',
                'labelOptions' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ])->textInput(['maxlength' => true]);
            
            echo $form->field($profile, 'address', [
                'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{hint}{error}</div></div></div>',
                'labelOptions' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ])->textInput(['maxlength' => true]);
            
            echo $form->field($profile, 'mobile_number', [
                'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{hint}{error}</div></div></div>',
                'labelOptions' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ])->textInput(['maxlength' => true]);
          ?>
          <div class="row col-md-offset-2">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>
          </div>
          <?php ActiveForm::end(); ?>
        </div>
				<div aria-labelledby="change-password-tab" id="change-password"
					class="tab-pane fade" role="tabpanel">
					<br />
          <?php
            $form = ActiveForm::begin([
              'id' => 'change-password-form',
              'enableAjaxValidation' => true,
              'options' => ['class' => 'form-horizontal'],
              'action'  => ['profile/change-password'],
            ]);
            echo $form->field($changePasswordModel, 'oldPassword', [
                'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{hint}{error}</div></div></div>',
                'labelOptions' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ])->passwordInput();
            echo $form->field($changePasswordModel, 'newPassword', [
                'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{hint}{error}</div></div></div>',
                'labelOptions' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ])->passwordInput();
            echo $form->field($changePasswordModel, 'rePassword', [
                'template'     => '<div class="form-group">{label} <div class="row"><div class="col-sm-4">{input}{hint}{error}</div></div></div>',
                'labelOptions' => [
                    'class' => 'col-sm-2 control-label',
                ],
            ])->passwordInput();
          ?>
          <div class="row col-md-offset-2">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success']) ?>
          </div>
           <?php ActiveForm::end(); ?>
        </div>
			</div>
		</div>
	</div>
</div>

<?php
$this->registerJs("
var profileIndex = new ProfileIndex({
	url: '" . \yii\helpers\Url::to(['/profile/index']) . "',
});
profileIndex.init();
");