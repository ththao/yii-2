<?php

namespace common\events;

use yii\base\Event;

class ResetPasswordEvent extends Event
{
    /**
     * @var \common\models\User
     */
    public $user;
    public $new_password;
} 