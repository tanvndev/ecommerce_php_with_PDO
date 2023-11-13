<?php

class DashBoard extends Controller
{

    use SweetAlert;
    private $req = null;
    private $productModel;
    private $userModel;
    function __construct()
    {
        $this->req = new Request;
        $this->productModel = $this->model('ProductModel');;
        $this->userModel = $this->model('UserModel');;
    }

    function Default()
    {

        $prodCount = $this->productModel->countProduct();
        $userCount = $this->userModel->countUser();

        $dataProdOrderBySold = $this->productModel->getAllProductOrderBySold();
        $dataProdAll = $this->productModel->getAllProduct();
        // $dataRatingsProd = $productModel->getAllRatingsProd(4) ?? [];

        $totalRevenue = 0;
        $totalSold = 0;
        foreach ($dataProdAll as $item) {
            $totalRevenue += ($item['price'] * $item['sold']);
            $totalSold += $item['sold'];
        }

        $this->view('layoutServer', [
            'title' => 'Bảng điều khiển',
            'active' => 'dashboard',
            'pages' => 'dashboard',
            'prodCount' => $prodCount['countProduct'] ?? 0,
            'userCount' => $userCount['countUser'] ?? 0,
            'dataProdOrderBySold' => $dataProdOrderBySold ?? [],
            'totalRevenue' => $totalRevenue ?? 0,
            'totalSold' => $totalSold ?? 0,
            'dataRatingsProd' => $dataRatingsProd ?? [],
        ]);
    }

    function storeCustom()
    {
        $this->view('layoutServer', [
            'title' => 'Bảng điều khiển',
            'active' => 'storeCustom',
            'pages' => 'storeCustom/storeCustom',
        ]);
    }
}
