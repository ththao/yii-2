<?php

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Json;

class PNotifyAlert extends Widget
{
    /**
     * @var array additional options to be passed to the pnotify JS plugin. Please refer to the
     * [pnotify project page](https://github.com/sciactive/pnotify) for available options.
     */
    public $clientOptions = [
        'animate_speed' => 100,
        'opacity' => .9
    ];

    /**
     * @var array the alert types configuration for the flash messages.
     * This array is setup as $key => $value, where:
     * - $key is the name of the session flash variable
     * - $value is the title of the alert
     */
    public $alertTypes = [
        'error' => 'Error',
        'danger' => 'Danger',
        'success' => 'Success',
        'info' => 'Info',
        'warning' => 'Warning'
    ];

    public function init()
    {
        $session = \Yii::$app->getSession();
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type])) {
                $data = (array) $data;
                foreach ($data as $message) {
                    $this->clientOptions['title'] = $this->alertTypes[$type];
                    $this->clientOptions['type'] = $type;
                    $this->clientOptions['text'] = $message;

                    $this->registerClientScript();
                }

                $session->removeFlash($type);
            }
        }
    }

    /**
     * register client script
     */
    public function registerClientScript()
    {
        $view = $this->getView();

        $options = Json::encode($this->clientOptions);

        $js = "new PNotify($options);";
        $view->registerJs($js);
    }
}