<?php

class Account extends Controller
{

    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    function Default()
    {
        header('location: /WEB2041_Ecommerce/account/login');
    }

    function login()
    {
        Authenticate::checkLogged();
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->loginUser();
        }

        $delMassage = Session::get('deleteMessage');
        $delType = Session::get('deleteType');

        $this->view('layoutLogin', [
            'title' => 'Đăng nhập',
            'pages' => 'account/login',
            'delMessage' => $delMassage,
            'delType' => $delType,
        ]);
    }
    function register()
    {
        Authenticate::checkLogged();
        $this->view('layoutLogin', [
            'title' => 'Đăng ký',
            'pages' => 'account/register'
        ]);
    }
    function registerApi()
    {
        echo $this->userModel->registerUser();
    }

    function forgotPassword()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->forgotPassword();
        }
        $this->view('layoutLogin', [
            'title' => 'Quên mật khẩu',
            'pages' => 'account/forgotPassword'
        ]);
    }

    function forgotPasswordApi()
    {
        echo $this->userModel->forgotPassword();
    }

    function finalForgotPassword($token)
    {
        $this->userModel->finalForgotUser($token);
    }


    function resetPassword()
    {
        $resetPasswordToken = json_decode(Cookie::get('resetPassword'), true);

        if (empty($resetPasswordToken) || !isset($resetPasswordToken['email']) || !isset($resetPasswordToken['token'])) {
            header('location: /WEB2041_Ecommerce/account/login');
        }

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->resetPassword($resetPasswordToken);
        }

        $this->view('layoutLogin', [
            'title' => 'Đặt lại mật khẩu',
            'pages' => 'account/resetPassword',
        ]);
    }

    function logout()
    {
        Session::destroy();
        header('location: /WEB2041_Ecommerce/home');
    }
    function finalRegisterUser($token)
    {
        $dataRegister = $this->userModel->finalRegisterUser($token);
        $this->view('layoutLogin', [
            'title' => 'Xác nhận đăng ký',
            'pages' => 'account/activeAccount',
            'dataRegister' => $dataRegister
        ]);
    }
}
