<?php

class Product extends Controller
{
    private $productModel;
    private $categoryModel;
    private $brandModel;
    private $attributeModel;



    public function __construct()
    {
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->brandModel = $this->model('BrandModel');
        $this->attributeModel = $this->model('AttributeModel');
    }

    function Default()
    {
        $delMassage = Session::get('toastMessage');
        $delType = Session::get('toastType');
        $prod = $this->productModel->getAllProduct() ?? [];
        $cateData = $this->categoryModel->getAllCategory() ?? [];

        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Danh sách sản phẩm',
            'pages' => 'product/product',
            'prodData' => $prod,
            'cateData' => $cateData,
            'delMessage' => $delMassage,
            'delType' => $delType,
        ]);
    }


    function addProduct()
    {
        // $cateData = $this->categoryModel->getAllCategory() ?? [];
        // $brandData = $this->brandModel->getAllBrand() ?? [];
        // $colorData = $this->attributeModel->getAttributeByName('Color') ?? [];
        // $sizeData = $this->attributeModel->getAttributeByName('Size') ?? [];
        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Thêm sản phẩm mới',

            'pages' => 'product/addProduct',
            // 'cateData' => $cateData,
            // 'brandData' => $brandData,
            // 'colorData' => $colorData,
            // 'sizeData' => $sizeData,
        ]);
    }

    function upadateProductController($id)
    {

        $prod = $this->productModel->getOneProduct($id) ?? [];
        $cateData = $this->categoryModel->getAllCategory() ??  [];
        $brandData = $this->brandModel->getAllBrand() ?? [];
        $colorData = $this->attributeModel->getAttributeByName('Color') ?? [];
        $sizeData = $this->attributeModel->getAttributeByName('Size') ?? [];

        //variant
        $prod_attrData = $this->attributeModel->getAllProduct_Atrribute($id) ?? [];
        $selectedId = [];
        foreach ($prod_attrData as $item) {
            $selectedId[] = $item['attribute_id'];
        }

        $this->view('layoutServer', [
            'active' => 'product',
            'title' => 'Cập nhập sản phẩm',
            'pages' => 'product/updateProduct',
            'cateData' => $cateData,
            'brandData' => $brandData,
            'prod' => $prod,
            'colorData' => $colorData,
            'sizeData' => $sizeData,
            'selectedId' => $selectedId,
        ]);
    }

    function deleteProductController($id)
    {
        $this->productModel->deleteProduct($id);
    }
    function ratingController()
    {
        $delMessage = Session::get('toastMessage');
        $delType = Session::get('toastType');

        $dataRatings = $this->productModel->getAllRatingsProd() ?? [];

        $this->view('layoutServer', [
            'title' => 'Danh sách đánh giá',
            'active' => 'ratings',
            'pages' => 'product/ratings',
            'delMessage' => $delMessage,
            'delType' => $delType,
            'dataRatings' => $dataRatings,

        ]);
    }
}
