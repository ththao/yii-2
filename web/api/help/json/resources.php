<?php

$params = require_once('params.php');

echo json_encode([
    'apis' => [
        [
            'path' => '/account.php',
            'description' => '',
        ]
    ],
    'basePath' => $params['apiHelpUrl'],
    'apiUrl' => $params['apiUrl'],
    'apiVersion' => '1.0.0',
    'swaggerVersion' => '1.0'
]);
