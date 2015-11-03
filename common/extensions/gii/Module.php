<?php

namespace common\extensions\gii;

use yii\helpers\ArrayHelper;

class Module extends \yii\gii\Module
{
    /**
     * Returns the list of the core code generator configurations.
     * @return array the list of the core code generator configurations.
     */
    protected function coreGenerators()
    {
        return ArrayHelper::merge(
            parent::coreGenerators(), [
                'ace-crud' => ['class' => 'common\extensions\gii\generators\crud\Generator'],
            ]
        );
    }
} 