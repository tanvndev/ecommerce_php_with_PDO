<?php
$config['app'] = [
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
    ],
    'globalMiddleware' => [
        Authentication::class
    ],
    'boot' => [
        AppServiceProvider::class
    ]
];
