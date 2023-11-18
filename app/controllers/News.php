<?php

class News extends Controller
{

    private $req = null;
    private $res = null;
    public function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
    }

    function Default()
    {
        $this->view('layoutClient', [
            'title' => 'Tin tức',
            'currentPath' => 'news',
            'pages' => 'news/news',

        ]);
    }
    function newsDetail()
    {
        $this->view('layoutClient', [
            'title' => 'Chi tiết tin tức',
            'currentPath' => 'news',
            'pages' => 'news/newsDetail',

        ]);
    }
}
