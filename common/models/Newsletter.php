<?php

namespace common\models;

use Yii;
use common\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%newsletters}}".
 *
 * @property integer $id
 * @property string $subject
 * @property string $content
 * @property integer $role_id
 * @property integer $status
 * @property integer $created_time
 * @property integer $updated_time
 */
class Newsletter extends \common\components\ActiveRecord
{
    const STATUS_PENDING = 1;
    const STATUS_SENT    = 2;
    const STATUS_DELETED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%newsletters}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'content', 'role_id', 'created_time'], 'required'],
            [['content'], 'string'],
            [['role_id', 'status', 'created_time', 'updated_time'], 'integer'],
            [['subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject' => Yii::t('app', 'Subject'),
            'content' => Yii::t('app', 'Content'),
            'role_id' => Yii::t('app', 'Send to'),
            'status' => Yii::t('app', 'Status'),
            'created_time' => Yii::t('app', 'Created Time'),
            'updated_time' => Yii::t('app', 'Updated Time'),
        ];
    }

    /**
     * @inheritdoc
     * @return NewsletterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsletterQuery(get_called_class());
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_SENT    => 'Sent',
            self::STATUS_DELETED  => 'Deleted',
        ];
    }

    public function getStatusString()
    {
        return self::getStatuses()[$this->status];
    }

    public function getRoleName() 
    {
        return Role::findOne(['id' => $this->role_id]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert === true) {
                $this->created_time = time();
                $this->updated_time = time();
            } else {
                $this->updated_time = time();
            }

            return true;
        }

        return false;
    }
}
