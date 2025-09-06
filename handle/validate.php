<?php

$validate = [
    'name' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'error' => 'Invalid name',
        'myOptions' => ['options' => ['regexp' => '/^[a-zA-Z0-9]{4,30}$/']]
    ],
    'email' => [
        'filter' => FILTER_VALIDATE_EMAIL,
        'error' => 'Invalid email',
    ],
    'phone' => [
        'filter' => FILTER_VALIDATE_INT,
        'error' => 'Invalid phone',
    ],
    'password' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'error' => 'Invalid password',
        'myOptions' => ['options' =>  ['regexp' => '/^[a-zA-Z0-9]{4,30}$/']]
    ]
];
