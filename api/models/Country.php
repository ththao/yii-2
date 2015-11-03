<?php

namespace api\models;

use yii\data\ActiveDataProvider;

class Country extends \common\models\Country
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
        	'name',
            'country_code',
        	'iso2_code',
        	'price',
        	'currency',
            'status'
        ];
    }

    public function all()
    {
        $query = Country::find()->byStatusActive();

        // prepare and return a data provider for the "index" action
        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
    }
} 