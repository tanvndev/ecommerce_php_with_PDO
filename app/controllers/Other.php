<?php

class Other extends Controller
{
    function Default()
    {
        $this->view('layoutLogin', [
            'title' => '404 Not Found',
            'pages' => 'others/notFound',
        ]);
    }
    function comingSoon()
    {
        $this->view('layoutLogin', [
            'title' => 'Coming Soon',
            'pages' => 'others/comingSoon',
        ]);
    }
}
