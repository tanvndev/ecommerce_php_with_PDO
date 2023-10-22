<?php
class Authenticate
{

    static function checkLogin()
    {
        $token = Session::get('userLogin');
        if (empty($token)) {
            header('location: /WEB2041_Ecommerce/account/login');
            return;
        }
        $dataUser = JWT::verifyJWT($token);
        if (empty($dataUser) || !$dataUser['valid']) {
            Session::destroy();
            header('location: /WEB2041_Ecommerce/account/login');
        } else {
            header('location: /WEB2041_Ecommerce/');
        }
    }

    static function checkLogged()
    {
        $token = Session::get('userLogin');

        if (!empty($token)) {
            $dataUser = JWT::verifyJWT($token);
            if (!empty($dataUser) && !$dataUser['valid']) {
                Session::destroy();
                header('location: /WEB2041_Ecommerce/account/login');
                return;
            } else {
                header('location: /WEB2041_Ecommerce/');
                return;
            }
        }
    }


    static function checkBlock()
    {
        $token = Session::get('userLogin');
        if (!empty($token)) {
            $dataUser = JWT::verifyJWT($token);
            if (!empty($dataUser) && $dataUser['payload']['isBlock'] == 1) {
                Session::destroy();
                header('location: /WEB2041_Ecommerce/account/login');
                return;
            }
        } else {
            header('location: /WEB2041_Ecommerce/account/login');
        }
    }

    static function checkRoleAdmin()
    {
        $token = Session::get('userLogin');

        if (empty($token)) {
            header('location: /WEB2041_Ecommerce/account/login');
            return;
        }

        $dataUser = JWT::verifyJWT($token);

        if (!empty($dataUser) && $dataUser['payload']['role'] == 2) {
            header('location: /WEB2041_Ecommerce/');
        }
    }
}
