<?php

class Category extends Controller
{
    use SweetAlert;
    private $categoryModel;
    private $req = null;
    private $res = null;
    function __construct()
    {
        $this->categoryModel = $this->model('CategoryModel');
        $this->req = new Request;
        $this->res = new Response;
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
            'active' => 'product',
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

            return $this->res->setToastSession('success', 'Thêm mới thành công.', 'admin/category');;
        } else {
            $this->Toast('error', 'Thêm thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }
    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'active' => 'product',
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
            return $this->res->setToastSession('success', 'Cập nhập thành công.', 'admin/category');;
        } else {
            $this->Toast('error', 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataCate);
        }
    }

    private function renderUpdatePage($dataCate = [])
    {
        $this->view('layoutServer', [
            'active' => 'product',
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

            return $this->res->setToastSession('error', 'Xoá thất bại.', 'admin/category');;
        }

        return $this->res->setToastSession('success', 'Xoá thành công.', 'admin/category');;
    }
}
