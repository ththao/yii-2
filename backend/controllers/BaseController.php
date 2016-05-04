<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{

    public function beforeAction($action)
    {

        Yii::$app->view->title = Yii::t('app', 'Yii2Template - Backend'); // Default

        if (Yii::$app->user->isGuest) {
        	$this->goHome();
        }
        if (!Yii::$app->user->identity->isAdmin()) {
        	throw new HttpException(403, 'You are not allowed to perform this action.');
        }
        
        return parent::beforeAction($action);
    }
}