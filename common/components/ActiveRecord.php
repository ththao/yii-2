<?php

namespace common\components;

class ActiveRecord extends \yii\db\ActiveRecord
{

    /**
     * @var int Inactive status
     */
    const STATUS_INACTIVE = 0;

    /**
     * @var int Active status
     */
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp'  => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => function () {
                    return time();
                },
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'created_time',
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_time',
                ],
            ],
        ];
    }

}
