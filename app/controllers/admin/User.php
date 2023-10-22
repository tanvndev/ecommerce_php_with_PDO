<?php
class User extends Controller
{
    private $userModel;
    function __construct()
    {
        $this->userModel = $this->modelAdmin('UserModel');
    }

    function userController()
    {
        $delMessage = Session::get('deleteMessage');
        $delType = Session::get('deleteType');

        $dataUserAd = $this->userModel->getAllUser() ?? [];


        $this->view('layoutServer', [
            'title' => 'Danh sách người dùng',
            'active' => 'user',
            'pages' => 'user/user',
            'dataUserAd' => $dataUserAd,
            'delMessage' => $delMessage,
            'delType' => $delType
        ]);
    }

    function addUserController()
    {
        $this->view('layoutServer', [
            'title' => 'Thêm người dùng',
            'active' => 'user',
            'pages' => 'user/addUser'
        ]);
    }

    function updateUserController($id)
    {
        $dataUserUp = $this->userModel->getOneUser($id) ?? [];

        $this->view('layoutServer', [
            'title' => 'Cập nhập người dùng',
            'active' => 'user',
            'pages' => 'user/updateUser',
            'dataUserUp' => $dataUserUp
        ]);
    }

    function deleteUserController($id)
    {
        $this->userModel->deleteUser($id);
    }
}
