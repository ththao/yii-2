<?php

namespace api\models;

use yii\data\ActiveDataProvider;

class Project extends \common\models\Project
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
        	'name',
            'website',
        	'price',
        	'phone',
            'status'
        ];
    }

    public function all()
    {
        $query = Project::find()->byStatusActive();

        // prepare and return a data provider for the "index" action
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
    }
} 