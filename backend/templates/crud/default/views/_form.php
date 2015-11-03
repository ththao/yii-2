<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model          = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\switchinput\SwitchBox;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

                    <?= "<?php " ?>$form = ActiveForm::begin([
                    'enableAjaxValidation' => true,
                    'id'                   => '<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-' . ($model->isNewRecord ? 'create' : 'update') . '-form',
                    'options'              => [
                    'class' => 'form-horizontal',
                    ],
                    ]); ?>

                    <?php
                    foreach ($generator->getColumnNames() as $attribute) {
                        if (in_array($attribute, $safeAttributes)) {
                            echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
                        }
                    }
                    ?>

                </div>
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-offset-2">
                    <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?= "<?php " ?>ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>