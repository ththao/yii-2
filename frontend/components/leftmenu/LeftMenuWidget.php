<?php

namespace frontend\components\leftmenu;

use Yii;
use yii\bootstrap\Widget;

class LeftMenuWidget extends Widget
{

    public function init()
    {
        
    }

    public function run()
    {
        return $this->render('index');
    }

    public function registerJs()
    {
        
    }

}
