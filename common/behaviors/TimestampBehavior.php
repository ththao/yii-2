<?php

namespace common\behaviors;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{

    public $createdAtAttribute = 'created_time';
    public $updatedAtAttribute = 'updated_time';

}
