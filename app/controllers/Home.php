<?php

class Home extends Controller
{
    private $productModel;
    private $categoryModel;
    use SweetAlert;
    private $req = null;

    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
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

        $dataCate = $this->categoryModel->getAllCategory() ?? [];
        $dataBanner = $this->productModel->getProdByCate() ?? [];
        $dataProdRecent = $this->productModel->getProdRecently() ?? [];
        $dataProdMostSold = $this->productModel->getProdMostSold() ?? [];


        $this->view('layoutClient', [
            'title' => 'Trang chủ',
            'currentPath' => 'home',
            'pages' => 'home',
            'dataCate' => $dataCate,
            'dataBanner' => $dataBanner,
            'dataProdRecent' => $dataProdRecent,
            'dataProdMostSold' => $dataProdMostSold,
        ]);
    }
}
