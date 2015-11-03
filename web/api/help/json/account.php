<?php

$params = require_once('params.php');

echo json_encode([
    'resourcePath' => '/account',
    'basePath' => $params['apiUrl'],
    'apis' => [
        [
            'path' => '/account/signup',
            'description' => 'Account Signup',
            'operations' => [
                [
                    'parameters' => [
                        [
                            'name' => 'first_name',
                            'description' => "The user's first name",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'last_name',
                            'description' => "The user's last name",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'password',
                            'description' => "The user's password",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'email',
                            'description' => "The user's email",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                    ],
                    'summary' => 'Signup a User',
                    'httpMethod' => 'POST',
                    'errorResponses' => [
                        [
                            'reason' => '[{field: username, message: "Username cannot be blank"}]',
                            'code' => 200
                        ]
                    ],
                    'nickname' => 'accountSignup',
                    'responseClass' => 'User',
                ],
            ]
        ],
        [
            'path' => '/account/login',
            'description' => 'Account Login',
            'operations' => [
                [
                    'parameters' => [
                        [
                            'name' => 'email',
                            'description' => "The user's email",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'password',
                            'description' => "The user's password",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                    ],
                    'summary' => 'Login a user',
                    'httpMethod' => 'POST',
                    'errorResponses' => [
                        [
                            'reason' => 'Incorrect username or password',
                            'code' => 200
                        ]
                    ],
                    'nickname' => 'accountLogin',
                    'responseClass' => 'User'
                ]
            ]
        ],
        [
            'path' => '/account/logout',
            'description' => 'Account Logout',
            'operations' => [
                [
                    'parameters' => [
                        [
                            'name' => 'api_key',
                            'description' => "The user's api_key",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'query'
                        ]
                    ],
                    'summary' => 'Logout a user',
                    'httpMethod' => 'GET',
                    'nickname' => 'accountLogout',
                    'responseMessages' => [
                        'code' => 200,
                        'message' => true
                    ]
                ]
            ]
        ],
        [
            'path' => '/account/change-password',
            'description' => 'Account Change password',
            'operations' => [
                [
                    'parameters' => [
                        [
                            'name' => 'old_password',
                            'description' => "The user's old password",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'new_password',
                            'description' => "The user's new password",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'confirm_new_password',
                            'description' => "The user's confirm new password",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'api_key',
                            'description' => "The user's api_key",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'query'
                        ]
                    ],
                    'summary' => 'Logout a user',
                    'httpMethod' => 'POST',
                    'nickname' => 'accountLogout',
                    'responseMessages' => [
                        'code' => 200,
                        'message' => true
                    ]
                ]
            ]
        ],
        /*[
            'path' => '/account/forgot',
            'description' => 'Forgot Password',
            'operations' => [
                [
                    'parameters' => [
                        [
                            'name' => 'email',
                            'description' => "The user's email address",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ]
                    ],
                    'summary' => 'Forgot password of a user',
                    'httpMethod' => 'POST',
                    'nickname' => 'accountForgot',
                    'responseMessages' => [
                        'code' => 200,
                        'message' => 'true'
                    ]
                ]
            ]
        ],*/
        [
            'path' => '/account/update',
            'description' => 'Update Client Profile',
            'operations' => [
                [
                    'parameters' => [
                        [
                            'name' => 'first_name',
                            'description' => "First name of user",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'last_name',
                            'description' => "Last name of user",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'form'
                        ],
                        [
                            'name' => 'api_key',
                            'description' => "The user's api_key",
                            'required' => true,
                            'dataType' => 'string',
                            'allowMultiple' => false,
                            'paramType' => 'query'
                        ]
                                             
                    ],
                    'summary' => 'Update user profile',
                    'httpMethod' => 'POST',
                    'errorResponses' => [
                        [
                            'reason' => '[{field: first_name, message: "First name cannot be blank"},{field: last_name, message: "Last name cannot be blank"}]',
                            'code' => 200
                        ]
                    ],
                    'nickname' => 'accountUpdate',
                    'responseClass' => 'User'
                ],
            ]
        ],
		
    ],
    'apiVersion' => $params['apiVersion'],
    'swaggerVersion' => $params['swaggerVersion'],
    'models' => [
        'User' => [
            'uniqueItems' => false,
            'properties' => [
                'id' => [
                    'uniqueItems' => false,
                    'type' => "int",
                    'required' => true,
                ],
                'email' => [
                    'uniqueItems' => false,
                    'type' => 'string',
                    'required' => true
                ],
                'first_name' => [
                    'uniqueItems' => false,
                    'type' => 'string',
                    'required' => true,
                ],
                'last_name' => [
                    'uniqueItems' => false,
                    'type' => 'string',
                    'required' => true,
                ],
                'last_login' => [
                    'uniqueItems' => false,
                    'type' => 'string',
                    'format' => 'dateTime',
                    'required' => true,
                ],
                'api_key' => [
                    'uniqueItems' => false,
                    'type' => 'string',
                    'required' => true,
                ]
            ],
            'id' => 'user',
            'type' => 'any',
            'required' => false
        ]
    ]
]);