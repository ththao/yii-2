<?php

namespace api\models;

use yii\helpers\ArrayHelper;
use Yii;

class Request extends \common\models\Request
{
    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
        	'client_id',
        	'client' => function() {
        		return $this->client->getFullName();
        	},
        	'worker_id',
        	'worker' => function() {
        		return $this->worker->getFullName();
        	},
        	'project_id',
        	'project' => function() {
        		return $this->project->name;
        	},
            'phone_number',
            'code',
            'price' => function() {
            	if ($trans = $this->getTransaction()) {
            		return $trans->price;
            	}
            	return '';
            },
            'status',
        	'created' => function() {
        		return $this->created_time;
        	},
        ];
    }
} 