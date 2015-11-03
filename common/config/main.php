<?php
return [
	'name' => 'Ceres Yii2 Template',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'UTC',
    'components' => [
        'settings' => [
            'class' => 'pheme\settings\components\Settings'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@cache'
        ],
        'urlManager'  => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
        ],
        'reCaptcha'   => [
            'name'    => 'reCaptcha',
            'class'   => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6Ld8fwwTAAAAABOCJWq0JTOp4ttmZP47UC6Pmy_e',
            'secret'  => '6Ld8fwwTAAAAABCK-AzdGqAHV6G-m7l19DocATXx',
        ],
        'mailer'      => [
            //'class'            => 'yii\swiftmailer\Mailer',
            'viewPath'         => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'paypal'      => [
            'class'         => 'common\components\PaypalComponent',
            'API_USERNAME'  => 'admin_api1.globalsuccesssoftware.vn',
            'API_PASSWORD'  => 'SP8WZ44AGEEJCV75',
            'API_SIGNATURE' => 'AVXPsbmaPOb5yX.sx6sPi1V2q5LSAuU5dhbae5ZyvLBjVUkkX7nb.CV9',
            'MODE'          => 'live'// `sandbox` or `live`
//            'API_USERNAME'  => 'test4.ceres_business1_api1.gmail.com',
//            'API_PASSWORD'  => '6RD6YWME6K365NFQ',
//            'API_SIGNATURE' => 'AQU0e5vuZCvSg-XJploSa.sGUDlpAK1AP4XZnmi8pJ72ZAJgUd5WMC5E',
//            'MODE'          => 'sandbox'// `sandbox` or `live`
        ],
        'mycomponent' => [
            'class' => 'common\components\MyComponent',
        ],
    ],
];
