<?php
$config['bank'] = [
    'vnpay' => [
        'vnp_TmnCode' => 'YNZ9MQNH',
        'vnp_HashSecret' => 'KEQVETQNIINJBWAIHFLEJJTQLCMPSFCN',
    ],
    'momo' => [
        Authentication::class
    ],
    'zalopay' => [
        AppServiceProvider::class
    ]
];
