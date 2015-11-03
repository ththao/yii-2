<?php

return [
    'homeUrl'    => '/admin',
    'components' => [
        'request'    => [
            'baseUrl'             => '/admin',
            'cookieValidationKey' => '',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
        ],
    ],
];
