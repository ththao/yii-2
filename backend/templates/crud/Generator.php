<?php

namespace app\templates\crud;

/**
 * Class Generator
 */
class Generator extends \yii\gii\generators\crud\Generator
{

    /**
     * Generates code for active field
     * @param string $attribute
     * @return string
     */
    public function generateActiveField($attribute)
    {
        $defaultFieldOptions = "[
            'template'     => '<div class=\"form-group\">{label} <div class=\"row\"><div class=\"col-sm-4\">{input}{error}{hint}</div></div></div>',
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
        ]";

        $tableSchema = $this->getTableSchema();
        if ($tableSchema === false || !isset($tableSchema->columns[$attribute])) {
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $attribute)) {
                return "\$form->field(\$model, '$attribute', $defaultFieldOptions)->passwordInput()";
            } else {
                return "\$form->field(\$model, '$attribute', $defaultFieldOptions)";
            }
        }
        $column = $tableSchema->columns[$attribute];
        if ($column->phpType === 'boolean') {
            return "\$form->field(\$model, '$attribute', $defaultFieldOptions)->checkbox()";
        } elseif ($column->type === 'text') {
            return "\$form->field(\$model, '$attribute', $defaultFieldOptions)->textarea(['rows' => 6])";
        } elseif ($column->name == 'status') {
            return "\$form->field(\$model, '$attribute', $defaultFieldOptions)->widget(SwitchBox::className(), [
                        'options'       => ['label' => false],
                        'clientOptions' => [
                            'size'     => 'normal',
                            'onColor'  => 'success',
                            'offColor' => 'danger'
                        ]
                    ])";
        } else {
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
                $input = 'passwordInput';
            } else {
                $input = 'textInput';
            }
            if (is_array($column->enumValues) && count($column->enumValues) > 0) {
                $dropDownOptions = [];
                foreach ($column->enumValues as $enumValue) {
                    $dropDownOptions[$enumValue] = Inflector::humanize($enumValue);
                }
                return "\$form->field(\$model, '$attribute', $defaultFieldOptions)->dropDownList("
                    . preg_replace("/\n\s*/", ' ', VarDumper::export($dropDownOptions)) . ", ['prompt' => ''])";
            } elseif ($column->phpType !== 'string' || $column->size === null) {
                return "\$form->field(\$model, '$attribute', $defaultFieldOptions)->$input()";
            } else {
                return "\$form->field(\$model, '$attribute', $defaultFieldOptions)->$input(['maxlength' => true])";
            }
        }
    }

}
