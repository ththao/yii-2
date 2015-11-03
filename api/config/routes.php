<?php

return [
    'POST account/signup' => 'account/signup',
    'POST account/login' => 'account/login',
    'POST account/update' => 'account/update',
    'POST account/picture' => 'account/picture',
    'POST account/change-password' => 'account/password',

	'GET request/countries' => 'request/countries',
	'GET request/projects' => 'request/projects',
	'POST request/create' => 'request/create',
	'GET request/<id:\d+>/capture-phone' => 'request/capture-phone',
	'GET request/<id:\d+>/get-code' => 'request/get-code',
];