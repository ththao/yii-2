<?php

namespace frontend\models;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $rePassword;
    /**
     * @var \common\models\User
     */
    

    
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword','newPassword', 'rePassword'], 'required'],
            ['rePassword', 'compare', 'compareAttribute' => 'newPassword'],
            ['newPassword', 'string', 'min' => 6],
            [['oldPassword'], 'checkOldPassword'],

        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function checkOldPassword($attribute, $params)
    {
        if (!Yii::$app->security->validatePassword($this->oldPassword, Yii::$app->user->identity->password_hash)) {
            $this->addError($attribute, 'Incorrect Old Password.');
        }
            
    }
    public function resetPassword()
    {
        $user = User::findOne(['id'=>Yii::$app->user->id]);
        if (Yii::$app->security->validatePassword($this->oldPassword, Yii::$app->user->identity->password_hash)) {
            $user->setPassword($this->newPassword);
            return $user->save(false);
        }
        return false;
    }

}
