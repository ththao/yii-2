<?php

namespace api\components;

use api\components\QueryParamAuth;
use api\models\Challenge;
use api\models\UserChallenge;
use api\models\Asset;
use api\models\AssetGroup;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use api\models\Photo;
use api\models\Group;
use api\models\Request;

class Controller extends \yii\rest\Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'authenticator' => [
                    'class' => QueryParamAuth::className(),
                    'tokenParam' => 'api_key'
                ],
            ]
        );
    }
    
    public function loadRequestModel($id)
    {
    	$model = Request::findOne(['id' => $id]);
        if ($model === null) {
            throw new NotFoundHttpException();
        }
        
        if (time() - $model->created_time > 180) {
        	throw new \Exception("Request timed out.");
        }

        return $model;
    }
} 