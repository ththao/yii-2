<?php

$config = [
    'homeUrl'    => '/api',
    'components' => [
        'request'    => [
            'baseUrl'             => '/api',
            'cookieValidationKey' => '',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]    = 'debug';
    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}
$config['modules']['debug'] = 'yii\debug\Module';


return $config;
