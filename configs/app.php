<?php
$config['app'] = [
    'globalMiddleware' => [
        Authentication::class
    ],
    'routeMiddleware' => [
        'account' => AuthIsLogin::class,
        'checkout' => AuthIsLogin::class,
        'orderDetail/(.+)' => AuthIsLogin::class,
        'updateUserCurrent' => AuthIsLogin::class,
        'checkout-final' => AuthIsLogin::class,
        'payment-final' => AuthIsLogin::class,
        'update-order-status' => AuthIsLogin::class,
        'cart' => AuthIsLogin::class,

        'admin/update-user/(.+)' => Authorization::class,
        'admin/delete-user' => Authorization::class,

        'admin/add-role' => Authorization::class,
        'admin/update-role/(.+)' => Authorization::class,
        'admin/delete-role' => Authorization::class,
    ],

    'boot' => [
        AppServiceProvider::class
    ]
];
