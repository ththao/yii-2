<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $display_name
 * @property string $address
 * @property string $address2
 * @property string $mobile_number
 * @property string $city
 * @property string $state_id
 * @property string $country_id
 * @property integer $created_time
 * @property integer $updated_time
 */
class Profile extends \common\components\ActiveRecord
{

    //SCENARIO
    const SCENARIO_SIGNUP = 'signup';
    const SCENARIO_UPDATE = 'update';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profiles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'created_time', 'updated_time'], 'integer'],
            [['first_name', 'last_name', 'display_name', 'address', 'address2', 'mobile_number', 'city', 'state_id', 'country_id'], 'string', 'max' => 255],
            [['first_name', 'last_name'], 'required', 'on' => self::SCENARIO_SIGNUP],
            [['first_name', 'last_name'], 'required', 'on' => self::SCENARIO_SIGNUP],
            [['first_name', 'last_name'], 'required', 'on' => self::SCENARIO_UPDATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'ID'),
            'user_id'       => Yii::t('app', 'User'),
            'first_name'    => Yii::t('app', 'First Name'),
            'last_name'     => Yii::t('app', 'Last Name'),
            'display_name'  => Yii::t('app', 'Display Name'),
            'address'       => Yii::t('app', 'Address'),
            'address2'      => Yii::t('app', 'Address2'),
            'mobile_number' => Yii::t('app', 'Mobile Number'),
            'city'          => Yii::t('app', 'City'),
            'state_id'      => Yii::t('app', 'State'),
            'country_id'    => Yii::t('app', 'Country'),
            'created_time'  => Yii::t('app', 'Created Time'),
            'updated_time'  => Yii::t('app', 'Updated Time'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\ProfileQuery(get_called_class());
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getUser()
    {
    	return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
