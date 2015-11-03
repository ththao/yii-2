<?php

namespace api\models\signup;

use api\models\User;
use yii\base\InvalidValueException;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

class NormalForm extends SignupAbstract
{
    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['password', 'required'],
                ['password', 'string', 'min' => 6],
            ]
        );
    }
} 