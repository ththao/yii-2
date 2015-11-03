<?php

namespace frontend\models;

use common\models\User;
use common\models\Profile;
use common\models\Role;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $rePassword;
    public $reCaptcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'password', 'rePassword', 'reCaptcha'], 'required'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6],
            ['rePassword', 'compare', 'compareAttribute' => 'password'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className()]
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if savin g fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user            = new User();
            $user->username  = $this->username;
            $user->email     = $this->email;
            $user->setPassword($this->password);
            $user->role_id   = Role::ROLE_CLIENT; // signup as Client
            $user->status    = User::STATUS_INACTIVE; // In-active when signup
            $user->create_ip = Yii::$app->getRequest()->getUserIP();
            $user->generateAuthKey();
            
            if ($user->save()) {
                // Insert Profile
                $profile               = new Profile;
                $profile->first_name   = $this->first_name;
                $profile->last_name    = $this->last_name;
                $profile->display_name = $this->first_name . " " . $this->last_name;
                $profile->user_id      = $user->id;
                if ($profile->save()) {
                    $user = User::findOne(['email' => $this->email,]);
                    
                    if ($user) {
                        return \Yii::$app->mailer->compose(['html' => 'verifySignUp-html', 'text' => 'verifySignUp-text'], ['user' => $user])
                        	->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
                        	->setTo($this->email)
                        	->setSubject('Confirm your registration')
                        	->send();
                    }
                }
                return false;
            }
        }

        return null;
    }

    public function attributeLabels()
    {
        return [
            'reCaptcha' => ''
        ];
    }

}
