<?php

class Brand extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $brandModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->brandModel = $this->model('BrandModel');
    }

    private function checkRoleAdmin()
    {

        $accessToken = null;
        //Check accessToken
        if (!empty(Session::get('userLogin'))) {
            $accessToken = JWT::verifyJWT(Session::get('userLogin')) ?? '';
        } else {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }

        //check accessToken con han
        if (!empty($accessToken) && isset($accessToken['error'])) {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }

        $dataUserCurrent = $accessToken['payload'];
        if ($dataUserCurrent['role_id'] == 3) {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }
    }


    function Default()
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $dataBrand = $this->brandModel->getAllBrand();

        $this->view('layoutServer', [
            'active' => 'brand',
            'pages' => 'brand/brand',
            'title' => 'Danh sách thương hiệu',
            'dataBrand' => $dataBrand,
        ]);
    }
    function getOneBrandApi($id)
    {
        $data = $this->brandModel->getOneBrand($id);
        echo json_encode($data ?? []);
    }

    function addBrand()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'admin/brand');
        }
        $type = 'error';

        $dataPost = $this->req->getFields();

        if (empty($dataPost['name'])) {
            return $this->res->setToastSession($type, 'Vui lòng không để trống.', 'admin/brand');
        }

        // Kiem tra da co thuong hieu nay chua

        $brandExist = $this->brandModel->checkBrandExisted($dataPost['name']);
        if (!empty($brandExist)) {
            return $this->res->setToastSession($type, 'Thương hiệu đã tồn tại.', 'admin/brand');
        }

        $dataInsert = [
            'name' => $dataPost['name']
        ];

        $success = $this->brandModel->addNewBrand($dataInsert);
        if (!$success) {
            return $this->res->setToastSession($type, 'Tạo mới thất bại.', 'admin/brand');
        }
        return $this->res->setToastSession('success', 'Tạo mới thành công.', 'admin/brand');
    }

    function updateBrand()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'admin/brand');
        }
        $type = 'error';

        $dataPost = $this->req->getFields();

        if (empty($dataPost['name'])) {
            return $this->res->setToastSession($type, 'Vui lòng không để trống.', 'admin/brand');
        }

        // Kiem tra da co thuong hieu nay chua

        $brandExist = $this->brandModel->checkBrandExisted($dataPost['name']);
        if (!empty($brandExist)) {
            return $this->res->setToastSession($type, 'Thương hiệu đã tồn tại.', 'admin/brand');
        }

        $dataUpdate = [
            'name' => $dataPost['name']
        ];

        $success = $this->brandModel->updateBrand($dataPost['id'], $dataUpdate);
        if (!$success) {
            return $this->res->setToastSession($type, 'Cập nhập thất bại.', 'admin/brand');
        }

        return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/brand');
    }

    function deleteBrand()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lỗi vui lòng thử lại.', 'admin/brand');
        }
        $dataPost = $this->req->getFields();

        $success = $this->brandModel->deleteBrand($dataPost['id']);

        if (!$success) {
            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/brand');
        }

        return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/brand');
    }
}
