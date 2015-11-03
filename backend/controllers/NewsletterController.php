<?php

namespace backend\controllers;

use Yii;
use common\models\Newsletter;
use backend\models\NewsletterSearch;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\User;

/**
* NewsletterController implements the CRUD actions for Newsletter model.
*/
class NewsletterController extends BaseController
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
					'actions' => ['index', 'create', 'view', 'send-news'],
					'allow'   => true,
					'roles'   => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	* Lists all Newsletter models.
	* @return mixed
	*/
	public function actionIndex()
	{
	    $searchModel = new NewsletterSearch();
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	    return $this->render('index', [
		    'searchModel' => $searchModel,
		    'dataProvider' => $dataProvider,
	    ]);
	}

	/**
	* Displays a single Newsletter model.
	* @param integer $id
	* @return mixed
	*/
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	* Creates a new Newsletter model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	* @return mixed
	*/
	public function actionCreate()
	{
		$model = new Newsletter();

		if (Yii::$app->request->isAjax && $model->load($_POST)) {
			Yii::$app->response->format = 'json';
			return \yii\widgets\ActiveForm::validate($model);
		}

		if ($model->load(Yii::$app->request->post())) {
			$model->status = Newsletter::STATUS_PENDING;
			$model->created_time = time();
			$model->updated_time = time();
			if ($model->save()) {
				Yii::$app->session->setFlash('success', 'Create Email Success');
				return $this->redirect('index');
			} else {
				
			}
			
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}
	
	public function actionSendNews($id) 
	{
		$newsletterModel = $this->findModel($id);
		$userModels = User::find()->where([
			'role_id' => $newsletterModel->role_id,
			'status'  => User::STATUS_ACTIVE,
		])->all();
		
		$mailer = Yii::$app->mailer->compose(['html' => 'newsLetter-html', 'text' => 'newsLetter-text'], ['content' => $newsletterModel->content,])
			->setTo(\Yii::$app->params['adminEmail'])
			->setFrom([\Yii::$app->params['adminEmail']])
			->setSubject('Newsletter - ' . $newsletterModel->subject);
		
		$emails = [];
		foreach ($userModels as $userInfo) {
			$emails[] = $userInfo->email;
		}
		$mailer->setBcc($emails);
		
        if ($mailer->send()) {
        	$newsletterModel->status = Newsletter::STATUS_SENT;
        	if ($newsletterModel->save()) {
        		Yii::$app->session->setFlash('success', 'Emails have been sent successfully');
        		return $this->redirect('index');
        	} else {
        		
        	}
        	
        }
	}
	
	/**
	* Finds the Newsletter model based on its primary key value.
	* If the model is not found, a 404 HTTP exception will be thrown.
	* @param integer $id
	* @return Newsletter the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
	protected function findModel($id)
	{
		if (($model = Newsletter::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
