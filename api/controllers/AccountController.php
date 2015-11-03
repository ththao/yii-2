<?php

namespace api\controllers;

use api\components\Controller;
use api\models\forms\LoginForm;
use api\models\signup\NormalForm;
use api\models\forms\ChangePasswordForm;
use yii\helpers\ArrayHelper;
use Yii;
use api\models\User;
use api\models\Request;
use common\models\Role;

class AccountController extends Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'except' => ['login', 'signup', 'facebook']
            ],
        ]);
    }

    /**
     * register a user
     *
     * @return \api\models\User
     */
    public function actionSignup()
    {
        $model = new NormalForm();
        $model->load(Yii::$app->request->getBodyParams(), '');

        if ($model->save()) {
            $model->getUser()->refresh();
            return $model->getUser();
        } else {
            return $model;
        }
    }
	
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->getBodyParams(), '');

        if ($model->login()) {
            $user = $model->getUser();
            
            return $user;
        } else {
            return $model;
        }
    }

    public function actionUpdate()
    {
        /** @var \api\models\User $user */
        $user = Yii::$app->user->identity;
        $user->load(Yii::$app->request->getBodyParams(), '');
        $user->save();
        
        $profile = $user->profile;
        $profile->load(Yii::$app->request->getBodyParams(), '');
        $profile->save();

        return $user;
    }

    public function actionPassword()
    {
        $model = new ChangePasswordForm();
        $model->load(Yii::$app->request->getBodyParams(), '');
        $model->user = Yii::$app->user->identity;
        $model->save();
        
        return $model;
    }
	
    public function actionLogout()
    {
    	$user = \Yii::$app->user->identity;
    	if ($user->logout()) {
    		return true;
    	} else {
    		return false;
    	}
    }
}