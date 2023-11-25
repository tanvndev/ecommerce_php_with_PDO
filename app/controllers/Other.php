<?php

class Other extends Controller
{
    private $storeCustom;
    function __construct()
    {
        $this->storeCustom = $this->model('StoreCustom');;
    }
    function Default()
    {
        $this->view('layoutLogin', [
            'title' => '404 Not Found',
            'pages' => 'others/notFound',
        ]);
    }
    function comingSoon()
    {
        $dataStoreCustom = $this->storeCustom->getAllStoreCustom();

        $this->view('layoutLogin', [
            'title' => 'Coming Soon',
            'pages' => 'others/comingSoon',
            'dataStoreCustom' => $dataStoreCustom,
        ]);
    }
}
