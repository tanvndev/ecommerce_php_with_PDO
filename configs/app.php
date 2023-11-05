<?php
$config['app'] = [
    'routeMiddleware' => [
        'thu-nghiem' => Authorization::class
    ],
    'globalMiddleware' => [
        Authentication::class
    ],
    'boot' => [
        AppServiceProvider::class
    ]
];
