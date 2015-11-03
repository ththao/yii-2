<?php
namespace api\models\signup;

use api\models\User;
use common\models\Profile;
use yii\base\Model;
use Yii;
use common\models\Role;

abstract class SignupAbstract extends Model
{
    protected $user;

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email'], 'required'],
            ['email', 'unique', 'targetClass' => '\common\models\User'],
            [['email'], 'email'],
        	['role', 'in', 'range' => ['Client']],
        	[['password', 'role'], 'safe']
        ];
    }

    /**
     * save a user info
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        $valid = false;
        if (!$runValidation || $this->validate($attributeNames)) {
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();

            try {
                $user = $this->saveUser();

                if ($this->hasErrors()) {
                    $valid = false;
                    $transaction->rollBack();
                } else {
                    $valid = true;
                    $transaction->commit();
                    $this->sendEmail();
                }

            } catch (\Exception $e) {
                $this->addError('error', $e->getMessage());
                $transaction->rollBack();
            }
        }

        return $valid;
    }

    /**
     * @return \api\models\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * save a user
     *
     * @return \api\models\User
     */
    public function saveUser()
    {
    	$role = Role::findOne(['name' => $this->role ? $this->role : 'Client']);
    	
        $model = new User();
        $model->attributes = $this->attributes;
        $model->role_id = $role->id;
        $model->status    = User::STATUS_INACTIVE; // In-active when signup
        $model->create_ip = Yii::$app->getRequest()->getUserIP();
        $model->setPassword($this->password);
        $model->generateAuthKey();
        
        if ($model->save(false)) {
        	$profile               = new Profile;
        	$profile->first_name   = $this->first_name;
        	$profile->last_name    = $this->last_name;
        	$profile->display_name = $this->first_name . " " . $this->last_name;
        	$profile->user_id      = $model->id;
        	$profile->save(false);
        	
            $this->user = $model;
        } else {
            $this->addErrors($model->getErrors());
        }

        return $model;
    }

    public function sendEmail()
    {
    	$res = \Yii::$app->mailer->compose(['html' => 'verifySignUp-html', 'text' => 'verifySignUp-text'], ['user' => $this->user])
	    	->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
	    	->setTo($this->email)
	    	->setSubject('Confirm your registration')
	    	->send();
    }
} 