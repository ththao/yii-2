<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RechargeForm extends Model
{

    public $price;
    public $tos;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'tos'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'price' => 'Price',
        	'tos' => 'Terms of Service',
        	['tos', 'in', 'range' => [1]],
        ];
    }

    public function getPriceList()
    {
        //@Todos: Price list should to be loaded from global param instead of define here
        return [
            '10.00'   => "$ 10.00 USD",
            '25.00'   => "$ 25.00 USD",
            '50.00'   => "$ 50.00 USD",
            '100.00'  => "$ 100.00 USD",
            '500.00'  => "$ 500.00 USD",
            '1000.00' => "$ 1000.00 USD",
        ];
    }
}