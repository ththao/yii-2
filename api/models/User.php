<?php

namespace api\models;

use yii\helpers\ArrayHelper;
use Yii;

class User extends \common\models\User
{
    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
        	'role_id',
        	'role' => function() {
        		return $this->role->name;
        	},
            'email',
            'balance' => function() {
            	return Yii::$app->params['currency'] . ($this->balance ? $this->balance : 0);
            },
            'status',
            'api_key' => function() {
                return $this->status ? $this->getAccessToken() : '';
            },
        ];
    }
    
    public function getAccessToken()
    {
        if (empty($this->api_key)) {
            $this->generateAccessToken();
            $this->save(false, ['api_key']);
        }

        return $this->api_key;
    }

    public function logout()
    {
        $this->api_key = null;
        return $this->save(false, ['api_key']);
    }
} 