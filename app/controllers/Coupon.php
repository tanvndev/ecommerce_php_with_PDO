<?php

class Coupon extends Controller
{

    function Default()
    {
        $this->view('layoutClient', [
            'title' => 'Ưu đãi dành riêng cho bạn',
            'currentPath' => 'coupon',
            'pages' => 'coupon/coupon',

        ]);
    }
}
