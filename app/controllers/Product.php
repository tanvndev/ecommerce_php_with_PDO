<?php

class Product extends Controller
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
        $dataCateList = $this->categoryModel->getAllCategory() ?? [];
        $dataColor = $this->productModel->getAttributeProd(
            'Color'
        ) ?? [];
        $dataSize = $this->productModel->getAttributeProd('Size') ?? [];
        $this->view('layoutClient', [
            'title' => 'Danh mục sản phẩm',
            'currentPath' => 'product/',
            'pages' => 'product/productCategory',
            'dataCateList' => $dataCateList,
            'dataColor' => $dataColor,
            'dataSize' => $dataSize,
        ]);
    }

    function filterProd($cate)
    {
        echo $this->productModel->getAllProduct($cate) ?? json_encode([]);
    }

    function productDetail($id)
    {
        $dataProd = $this->productModel->getOneProd($id) ?? [];
        $dataImageProd = $this->productModel->getImageProd($id) ?? [];
        $dataVariant = $this->productModel->getVariantProd($id) ?? [];
        $dataProdRecent = $this->productModel->getProdRecently() ?? [];


        $this->view('layoutClient', [
            'title' => $dataProd['title'],
            'thumb' => $dataProd['thumb'],
            'currentPath' => 'product/',
            'pages' => 'product/detailProduct',
            'dataProd' => $dataProd,
            'dataImageProd' => $dataImageProd,
            'dataVariant' => $dataVariant,
            'dataProdRecent' => $dataProdRecent,
        ]);
    }

    function addRatingProd()
    {
        echo $this->productModel->addRatingProd();
    }
    function getAllRatingsProd($idProd)

    {
        echo $this->productModel->getAllRatings($idProd);
    }
}
