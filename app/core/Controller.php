<?php
class Controller
{
    function model($model)
    {
        require_once './app/models/' . $model . '.php';
        return new $model;
    }
    function modelAdmin($model)
    {
        require_once './app/models/admin/' . $model . '.php';
        return new $model;
    }

    function view($view, $data = [])
    {
        if (!empty(ViewShare::$dataShare)) {
            $data = array_merge($data, ViewShare::$dataShare);
        }
        extract($data);

        require_once './app/views/layout/' . $view . '.php';
    }
}
