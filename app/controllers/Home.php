<?php

class Home extends Controller
{
    private $productModel;
    private $categoryModel;
    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    function Default()
    {
        Session::unsetSession('limitProd');
        $dataCate = $this->categoryModel->getAllCategory() ?? [];
        $dataProdNft = $this->productModel->getProdByCateNft() ?? [];
        $dataProdRecent = $this->productModel->getProdRecently() ?? [];
        $dataProdMostSold = $this->productModel->getProdMostSold() ?? [];

        $this->view('layoutClient', [
            'title' => 'Trang chủ',
            'currentPath' => 'home',
            'pages' => 'home',
            'dataCate' => $dataCate,
            'dataProdRecent' => $dataProdRecent,
            'dataProdNft' => $dataProdNft,
            'dataProdMostSold' => $dataProdMostSold,
        ]);
    }
}
