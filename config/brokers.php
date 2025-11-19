<?php

return [
    'brokers' => [
        'rabbitmq' => [
            'host' => env('RABBITMQ_DEFAULT_HOST', 'rabbitmq'),
            'user' => env('RABBITMQ_DEFAULT_USER', 'user'),
            'password' => env('RABBITMQ_DEFAULT_PASS', 'password'),
        ]
    ]
];
