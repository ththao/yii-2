<?php

namespace api\controllers;

use api\components\Controller;
use yii\helpers\ArrayHelper;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'authenticator' => [
                    'except' => ['index']
                ],
            ]
        );
    }

    public function actionIndex()
    {
        return '';
    }
} 