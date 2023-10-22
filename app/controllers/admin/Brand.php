<?php

class Brand extends Controller
{

    private $brandModel;
    function __construct()
    {
        $this->brandModel = $this->modelAdmin('BrandModel');
    }

    function brandController()
    {
        $delMassage = Session::get('deleteMessage');
        $delType = Session::get('deleteType');

        $dataBrand = $this->brandModel->getAllBrand() ?? [];

        $this->view('layoutServer', [
            'pages' => 'brand/brand',
            'title' => 'Danh sách thương hiệu',

            'dataBrand' => $dataBrand,
            'delMessage' => $delMassage,
            'delType' => $delType
        ]);
    }

    function addBrandController()
    {
        $this->view('layoutServer', [
            'pages' => 'brand/addBrand',
            'title' => 'Thêm thương hiệu',


        ]);
    }

    function updateBrandController($id)
    {
        $dataBrand = $this->brandModel->getOneBrand($id) ?? [];
        echo json_encode($dataBrand);
    }

    function deleteBrandController($id)
    {
        $this->brandModel->deleteBrand($id);
    }
}
