<?php
class Test extends Controller
{
    private $req = null;
    function __construct()
    {
        $this->req = new Request;
    }
    function Default()
    {
    }

    function detail($i)
    {
        echo 'Trang test - ' . $i;
    }

    function get_user()
    {
        $this->view('layoutLogin', [
            'title' => 'trang thu nghiem',
            'pages' => 'test/viewTest',

        ]);
    }
    function modelTest()
    {
        $testModel = $this->model('TestModel');
        echo '<pre>';
        print_r($testModel->getList());
        echo '</pre>';
    }

    function post_user()
    {
        // set rules
        $this->req->rules([
            'fullname' => 'required|min:5|max:30',
            'email' => 'required|email|min:6',
            'password' => 'required|strong',
            're_password' => 'match:password',
        ]);

        // set message

        $this->req->message([
            'fullname.required' => 'Ho ten khong duoc de trong',
            'fullname.min' => 'Toi thieu 5 ky tu',
            'fullname.max' => 'Toi da 8 ky tu',
            'email.required' => 'Email khong duoc de trong',
            'email.email' => 'Dung dinh dang email',
            'email.min' => 'Toi thieu 6 ky tu',
            'password.required' => 'Mat khau khong duoc de trong',
            'password.strong' => 'Mat khau chua dung yeu cau',
            're_password.match' => 'Mat khau khong khop',
        ]);

        $validate = $this->req->validate();
        $this->view('layoutLogin', [
            'pages' => 'test/viewTest',
            'dataError' => $this->req->errors(),
        ]);
    }
}
