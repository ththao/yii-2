<?php
namespace api\models\forms;

use api\models\User;
use yii\base\Model;


class ChangePasswordForm extends Model
{
    /**
     * @var \api\models\User
     */
    public $user;
    public $old_password;
    public $new_password;

    public function rules()
    {
        return [
            [['user', 'old_password', 'new_password'], 'required'],
            [['new_password'], 'string', 'min' => 6, 'tooShort' => 'Password should be at least {min} characters long'],
            ['old_password', 'validateOldPassword']
        ];
    }

    /**
     * custom validation for the old password
     * @param $attribute
     * @return bool
     */
    public function validateOldPassword($attribute)
    {
        $user = $this->user;
        if ($user === null) {
            return false;
        }
        if (!$user->validatePassword($this->old_password)) {
            $this->addError('old_password', 'Invalid old password');
        }
    }

    /**
     * save a new password
     * @param bool $runValidation
     * @param null $attributes
     * @return bool
     */
    public function save($runValidation = true, $attributes = null)
    {
        if ($runValidation && !$this->validate($attributes)) {
            return false;
        }

        $user = $this->user;
        $user->password_hash = $user->hashPassword($this->new_password);
        return $user->save(true, ['password_hash']);
    }
}