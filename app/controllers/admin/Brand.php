<?php

class Brand extends Controller
{
    use SweetAlert;
    private $brandModel;
    private $req = null;
    function __construct()
    {
        $this->brandModel = $this->model('BrandModel');
        $this->req = new Request;
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
        $type = 'error';

        $dataPost = $this->req->getFields();

        if (empty($dataPost['name'])) {
            Session::set('toastMessage', 'Vui lòng không để trống.');
            Session::set('toastType', $type);
            return header('location: /WEB2041_Ecommerce/admin/brand');
        }

        $dataInsert = [
            'name' => $dataPost['name']
        ];

        $success = $this->brandModel->addNewBrand($dataInsert);
        if (!$success) {
            Session::set('toastMessage', 'Tạo mới thất bại.');
            Session::set('toastType', $type);
            return header('location: /WEB2041_Ecommerce/admin/brand');
        }

        Session::set('toastMessage', 'Tạo mới thành công.');
        Session::set('toastType', 'success');
        return header('location: /WEB2041_Ecommerce/admin/brand');
    }

    function updateBrand()
    {
        $type = 'error';

        $dataPost = $this->req->getFields();

        if (empty($dataPost['name'])) {
            Session::set('toastMessage', 'Vui lòng không để trống.');
            Session::set('toastType', $type);
            return header('location: /WEB2041_Ecommerce/admin/brand');
        }

        $dataUpdate = [
            'name' => $dataPost['name']
        ];

        $success = $this->brandModel->updateBrand($dataPost['id'], $dataUpdate);
        if (!$success) {
            Session::set('toastMessage', 'Cập nhập thất bại.');
            Session::set('toastType', $type);
            return header('location: /WEB2041_Ecommerce/admin/brand');
        }

        Session::set('toastMessage', 'Cập nhập thành công.');
        Session::set('toastType', 'success');
        return header('location: /WEB2041_Ecommerce/admin/brand');
    }

    function deleteBrand()
    {
        $dataPost = $this->req->getFields();

        $success = $this->brandModel->deleteBrand($dataPost['id']);

        if (!$success) {
            Session::set('toastMessage', 'Xoá thất bại.');
            Session::set('toastType', 'error');
            return header('location: /WEB2041_Ecommerce/admin/brand');
        }

        Session::set('toastMessage', 'Xoá thành công.');
        Session::set('toastType', 'success');
        return header('location: /WEB2041_Ecommerce/admin/brand');
    }
}
