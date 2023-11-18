<?php

class Contact extends Controller
{

    public function __construct()
    {
    }

    function Default()
    {
        $this->view('layoutClient', [
            'title' => 'Liên hệ',
            'currentPath' => 'contact',
            'pages' => 'contact/contact',

        ]);
    }
}
