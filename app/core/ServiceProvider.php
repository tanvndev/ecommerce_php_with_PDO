<?php

class ServiceProvider extends DB
{
    private $idUser;
    public function __construct()
    {
        parent::__construct();
        $this->dataUserLogin();
    }
    private function dataUserLogin()
    {
        $token = Session::get('userLogin');

        if (!empty($token)) {
            $dataUser = JWT::verifyJWT($token);
            if (!empty($dataUser) && $dataUser['valid']) {
                ViewShare::share('dataUser', $dataUser);
                $this->idUser = $dataUser['payload']['user_id'];
                return true;
            }
        }
    }
}
