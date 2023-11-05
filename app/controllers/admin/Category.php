<?php

class Category extends Controller
{
    use SweetAlert;
    private $categoryModel;
    private $req = null;
    function __construct()
    {
        $this->categoryModel = $this->model('CategoryModel');
        $this->req = new Request;
    }
    function Default()
    {

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $dataCate = $this->categoryModel->getAllCategory();

        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Danh sách danh mục',
            'pages' => 'category/category',
            'dataCate' => $dataCate ?? [],
        ]);
    }


    function addCategory()
    {
        $dataValueOld = [];
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Get image
        $image = $_FILES['image'] ?? '';

        //Validate
        if (empty($dataPost['name']) || empty($image['name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderAddPage($dataValueOld);
        }

        //Get name after uploads image
        $imageName = Format::uploadSingleImage($image, 'category');
        if ($imageName['error']) {
            $this->Toast('error', $imageName['error']);
            return $this->renderAddPage($dataValueOld);
        }

        $dataInsert = [
            'name' => $dataPost['name'],
            'image' => $imageName['success']
        ];

        $createCategory = $this->categoryModel->addNewCategory($dataInsert);

        if ($createCategory) {
            Session::set('toastMessage', 'Thêm mới thành công.');
            Session::set('toastType', 'success');
            header('location: /WEB2041_Ecommerce/admin/category');
            return;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }
    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Thêm danh mục',
            'pages' => 'category/addCategory',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }

    function updateCategory($id)
    {
        $dataCate = $this->categoryModel->getOneCategory($id) ?? [];

        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataCate);
        }
        //Get data post
        $dataPost = $this->req->getFields();

        //Get image
        $image = $_FILES['image'] ?? '';

        //Validate
        if (empty($dataPost['name'])) {
            $this->Toast('error', 'Vui lòng không để trống.');
            return $this->renderUpdatePage($dataCate);
        }

        $dataUpdate = [
            'name' => $dataPost['name'],
        ];

        if (!empty($image['name'])) {
            //Get name after uploads image
            $imageName = Format::uploadSingleImage($image, 'category');
            if ($imageName['error']) {
                $this->Toast('error', $imageName['error']);
                return $this->renderUpdatePage($dataCate);
            }
            $dataUpdate['image'] = $imageName['success'];
        }

        $updateCategory = $this->categoryModel->updateCategory($id, $dataUpdate);

        if ($updateCategory) {
            Session::set('toastMessage', 'Cập nhập thành công.');
            Session::set('toastType', 'success');
            header('location: /WEB2041_Ecommerce/admin/category');
            return;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataCate);
        }
    }

    private function renderUpdatePage($dataCate = [])
    {
        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Cập nhập danh mục',
            'pages' => 'category/updateCategory',
            'dataCate' => $dataCate
        ]);
    }



    function deleteCategory()
    {
        $dataPost = $this->req->getFields();

        $success = $this->categoryModel->deleteCategory($dataPost['id']);

        if (!$success) {
            Session::set('toastMessage', 'Xoá thất bại.');
            Session::set('toastType', 'error');
            return header('location: /WEB2041_Ecommerce/admin/category');
        }

        Session::set('toastMessage', 'Xoá thành công.');
        Session::set('toastType', 'success');
        return header('location: /WEB2041_Ecommerce/admin/category');
    }
}
