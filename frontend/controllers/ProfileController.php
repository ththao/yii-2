<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Country;
use common\models\User;
use common\models\Role;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use common\models\Profile;
use frontend\models\ChangePasswordForm;

/**
 * ProfileController controller
 */
class ProfileController extends Controller
{
	public $defaultAction = 'index';
	
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $this->layout = 'user';

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            $this->goHome();
        }
        return parent::beforeAction($action);
    }
    
    public function actionUpdate() {
        $profile = Profile::findOne(['user_id' => Yii::$app->user->identity->id]);
        
        if ($profile->user->isClient()) {
        	$profile->scenario = Profile::SCENARIO_CLIENT_SIGNUP;
        } else {
        	$profile->scenario = Profile::SCENARIO_WORKER_UPDATE;
        }
        
        if (Yii::$app->request->isPost) {
            if ($profile->load(Yii::$app->request->post())) {
                $profile->updated_time = time();
                $profile->save(false);
                Yii::$app->getSession()->setFlash('success', 'Profile has been updated successfully.');
                
                return $this->redirect(\yii\helpers\Url::to(['/profile']));
            }
        }
    }

    public function actionChangePassword()
    {
        $changePasswordModel = new ChangePasswordForm;
        if (Yii::$app->request->isAjax && $changePasswordModel->load ( $_POST )) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate ( $changePasswordModel );
        }
        if (Yii::$app->request->isPost) {
            if($changePasswordModel->load(Yii::$app->request->post())) {
                if ($changePasswordModel->resetPassword()) {
                    Yii::$app->getSession()->setFlash('success', 'Password has been changed successfully.');
                    
                } else {
                    Yii::$app->getSession()->setFlash('danger', 'There was an error when trying to change password.');
                }
                return $this->redirect(\yii\helpers\Url::to(['/profile']));
            }
        }
    }

    public function actionIndex() 
    {
        $profile = Profile::findOne(['user_id' => Yii::$app->user->identity->id]);
        
        $changePasswordModel = new ChangePasswordForm;
        
        return $this->render('index', [
        	'profile'  => $profile,
        	'changePasswordModel' => $changePasswordModel,
        ]);
    }
}