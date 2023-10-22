<?php

class Category extends Controller
{
    private $categoryModel;
    function __construct()
    {
        $this->categoryModel = $this->modelAdmin('CategoryModel');
    }

    function categoryController()
    {
        $delMessage = Session::get('deleteMessage');
        $delType = Session::get('deleteType');

        $dataCate = $this->categoryModel->getAllCategory() ?? [];

        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Danh sách danh mục',

            'pages' => 'category/category',
            'dataCate' => $dataCate,
            'delMessage' => $delMessage,
            'delType' => $delType
        ]);
    }

    function addCategoryController()
    {

        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Thêm danh mục',

            'pages' => 'category/addCategory'
        ]);
    }

    function updateCategoryController($id)
    {

        $dataCate = $this->categoryModel->getOneCategory($id) ?? [];

        $this->view('layoutServer', [
            'active' => 'category',
            'title' => 'Cập nhập danh mục',

            'pages' => 'category/updateCategory',
            'dataCate' => $dataCate
        ]);
    }

    function deleteCategoryController($id)
    {

        $this->categoryModel->deleteCategory($id);
    }
}
