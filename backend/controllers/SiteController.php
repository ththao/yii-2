<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\AdminLoginForm;
use common\models\Auth;
use common\models\User;
use common\models\Profile;
use yii\filters\VerbFilter;
use common\models\Role;
use common\models\Request;
use common\models\PaypalTransaction;
use backend\assets\AppAsset;
use yii\web\Response;
use common\models\Activity;

/**
 * Site controller
 */
class SiteController extends Controller
{
	public $enableCsrfValidation = false;
	
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow'   => true,
                    ],
                    [
                        'actions' => ['auth'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'timeline', 'load-more'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'auth'  => [
                'class'           => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
    	if (Yii::$app->user->isGuest) {
    		$this->goHome();
    	}
    	if (!Yii::$app->user->identity->isAdmin()) {
    		throw new HttpException(403, 'You are not allowed to perform this action.');
    	}

        return $this->render('index',[]);
    }
    
    public function actionLoadMore()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
                throw new HttpException(403, 'You are not allowed to perform this action.');
            }
            
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $min = Yii::$app->request->post('min');
            
            $query = Activity::find()->orderBy('id DESC')->limit(20);
            if ($min) {
            	$query->andWhere('id < :min',[':min' => $min]);
            }
            //$query->andWhere("created_time >= " . strtotime(date("Y-m-d")));
             
            $timelines = $query->all();
            if ($timelines) {
            	return $this->renderAjax('timeline', ['timelines' => $timelines]);
            }
            return FALSE;
        }
        
        return FALSE;
    }
    
    public function actionTimeline()
    {
       
    	if (Yii::$app->request->isAjax) {
    		if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
    			throw new HttpException(403, 'You are not allowed to perform this action.');
    		}
    		
    		Yii::$app->response->format = Response::FORMAT_JSON;
    		$maxId = \Yii::$app->db->createCommand('SELECT MAX(activities.id) FROM activities')->queryAll();
           
            if (Yii::$app->request->post()) {
                if (Yii::$app->request->post('max') ==  $maxId[0]['MAX(activities.id)']) {
                    return FALSE;
                }
                if (Yii::$app->request->post('max') < $maxId[0]['MAX(activities.id)']) {
                    if (Yii::$app->request->post('max') == 0) {
                        $timelines = Activity::find()->andWhere("created_time >= " . strtotime(date("Y-m-d")))->andWhere('id <= (SELECT MAX(activities.id) FROM activities)')->orderBy(['id' => SORT_DESC])->limit(20)->all();
                    } else {
                        $timelines = Activity::find()->andWhere("created_time >= " . strtotime(date("Y-m-d")))->andWhere('id = (SELECT MAX(activities.id) FROM activities)')->orderBy(['id' => SORT_DESC])->all();
                    }
                }
            }
            if (isset($timelines) && $timelines) {
                return $this->renderAjax('timeline', ['timelines' => $timelines]);
            }
            return FALSE;
    	}
    }

    public function actionLogin()
    {
        $this->layout = 'no_column';

        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('login', [
            	'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }

}