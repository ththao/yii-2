<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'verify'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'info', 'email'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function redirectUser()
    {
    	if (!\Yii::$app->user->isGuest) {
    		$user = User::findOne(['id' => \Yii::$app->user->id]);
    		if ($user->isAdmin()) {
    			return $this->redirect('/admin');
    		} else {
    			return $this->redirect('/profile');
    		}
    	}
    }

    public function actionIndex()
    {
        $this->redirectUser();
        
        return $this->render('index', ['model' => new LoginForm()]);
    }

    public function actionLogin()
    {
        $this->redirectUser();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/profile');
        } else {
            return $this->render('login', [
				'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            if ($model->sendEmail($model->getEmailByType())) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                    'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSignup()
    {
    	$this->redirectUser();
    	
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->signup()) {
                Yii::$app->session->setFlash('success', 'Your registration is now complete! Please check your email to verify your account.');
                return $this->goBack();
            }
        }

        return $this->render('signup', ['model' => $model]);
    }

    public function actionVerify()
    {
        if (Yii::$app->request->get()) {
            $auth_key = Yii::$app->request->get();
            $user     = User::find()->where(['auth_key' => $auth_key])->one();
            if ($user) {
            	$user->auth_key = '';
                $user->status = User::STATUS_ACTIVE;
                
                if ($user->save() && Yii::$app->getUser()->login($user)) {
                    Yii::$app->session->setFlash('success', 'Sign Up Successfully!');
                    return $this->goHome();
                }
            }
        }
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', ['model' => $model]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', ['model' => $model]);
    }

    public function actionEmail()
    {
        Yii::$app->mailer->compose(['html' => 'sample'], [])
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
            ->setTo("dakiquang@gmail.com")
            ->setSubject('demo')
            ->send();
    }
}