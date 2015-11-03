<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-backend',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log', 'gii'],
    'modules'             => [
        'gii' => [
            'class'      => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '118.69.72.197'],
            'generators' => [
                'crud' => [
                    'class'     => 'app\templates\crud\Generator',
                    'templates' => [
                        'adminLteCrud' => '@app/templates/crud/default',
                    ],
                ],
            ],
        ],
    ],
    'components'          => [
        'user'                 => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => [
                'name' => '_backendUser', // unique for backend
                'path' => '/admin'  // correct path for the backend app.
            ]
        ],
        'session'              => [
            'name'     => '_backendSessionId', // unique for backend
            'savePath' => __DIR__ . '/../runtime', // a temporary folder on backend
        ],
        'authClientCollection' => [
            'class'   => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class'        => 'yii\authclient\clients\GoogleOAuth',
                    'clientId'     => '1066130987160-1hmanaatpep20abivnf76k7877ft1k9l.apps.googleusercontent.com',
                    'clientSecret' => 'vZGrbNeEXZGYlNqCM8vYl2jE',
                ],
            ],
        ],
        'assetManager'         => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@bower/bootstrap/dist',
                    'css'        => [
                        YII_ENV == 'dev' ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ],
                    'js'         => [
                        YII_ENV == 'dev' ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ],
                ],
            ],
        ],
        'log'                  => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler'         => [
            'errorAction' => 'site/error',
        ],
    ],
    'params'              => $params,
];
