<?php
require_once 'admin/Product.php';
require_once 'admin/Category.php';
require_once 'admin/Brand.php';
require_once 'admin/Attribute.php';
require_once 'admin/User.php';


class Admin extends Controller
{

    use SweetAlert;

    public function __construct()
    {
        Authenticate::checkRoleAdmin();
    }

    function Default()
    {
        $productModel = $this->model('ProductModel');
        $userModel = $this->model('UserModel');
        $prodCount = $productModel->countProduct() ?? 0;
        $userCount = $userModel->countUser() ?? 0;

        $dataProdOrderBySold = $productModel->getAllProductOrderBySold() ?? [];
        $dataProdAll = $productModel->getAllProduct() ?? [];
        $dataRatingsProd = $productModel->getAllRatingsProd(4) ?? [];

        $totalRevenue = 0;
        $totalSold = 0;
        foreach ($dataProdAll as $item) {
            $totalRevenue += ($item['price'] * $item['sold']);
            $totalSold += $item['sold'];
        }

        // Services::uploadToCloudinary();
        $this->view('layoutServer', [
            'title' => 'Bảng điều khiển',
            'active' => 'dashboard',
            'pages' => 'dashboard',
            'prodCount' => $prodCount,
            'userCount' => $userCount,
            'dataProdOrderBySold' => $dataProdOrderBySold,
            'totalRevenue' => $totalRevenue,
            'totalSold' => $totalSold,
            'dataRatingsProd' => $dataRatingsProd,
        ]);
    }



    // product action
    function product()
    {
        $prod = new Product();
        $prod->productController();
    }

    function addProduct()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $productModel = $this->model('ProductModel');
            $productModel->addNewProduct();
        }

        $prod = new Product();
        $prod->addProductController();
    }

    function updateProduct($id)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $productModel = $this->model('ProductModel');
            $productModel->updateProduct($id);
        }

        $prod = new Product();
        $prod->upadateProductController($id);
    }

    function deleteProduct()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $prod = new Product();
            $prod->deleteProductController($id);
        } else {
            $this->Toast('error', 'Xoá thất bại.');
        }
    }



    //end product action


    //Category action

    function category()
    {
        $cate = new Category();
        $cate->categoryController();
    }

    function addCategory()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryModel = $this->model('CategoryModel');
            $categoryModel->addNewCategory();
        }

        $cate = new Category();
        $cate->addCategoryController();
    }


    function updateCategory($id)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoryModel = $this->model('CategoryModel');
            $categoryModel->updateCategory($id);
        }

        $cate = new Category();
        $cate->updateCategoryController($id);
    }

    function deleteCategory()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $cate = new Category();
            $cate->deleteCategoryController($id);
        } else {
            $this->Toast('error', 'Xoá thất bại.');
        }
    }
    //End Category action


    //Brand action

    function brand()
    {
        $cate = new Brand();
        $cate->brandController();
    }

    function addBrand()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $brandModel = $this->model('brandModel');
            $brandModel->addNewBrand();
        }

        $brand = new Brand();
        $brand->addBrandController();
    }

    function getOneBrand($id)
    {
        $brand = new Brand();
        $brand->updateBrandController($id);
    }

    function updateBrand()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $idBrand = $_POST['id'];
            $brandModel = $this->model('brandModel');
            $brandModel->updateBrand($idBrand);
        }
    }

    function deleteBrand()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $brand = new Brand();
            $brand->deleteBrandController($id);
        } else {
            $this->Toast('error', 'Xoá thất bại.');
        }
    }
    //End Brand action


    //Attribute action

    function attribute()
    {
        $atrribute = new Attributes();
        $atrribute->attributeController();
    }

    function addAttribute()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $attributeModel = $this->model('AttributeModel');
            $attributeModel->addNewAttribute();
        }

        $atrribute = new Attributes();
        $atrribute->addAttributeController();
    }


    function updateAttribute($id)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $attributeModel = $this->model('AttributeModel');
            $attributeModel->updateAttribute($id);
        }

        $variant = new Attributes();
        $variant->updateAttributeController($id);
    }

    function deleteAttribute()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $variant = new Attributes();
            $variant->deleteAttributeController($id);
        } else {
            $this->Toast('error', 'Xoá thất bại.');
        }
    }
    //End Attribute action



    // User action

    function user()
    {
        $user = new User();
        $user->userController();
    }

    function addUser()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('UserModel');
            $userModel->addNewUser();
        }

        $user = new User();
        $user->addUserController();
    }


    function updateUser($id)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('UserModel');
            $userModel->updateUser($id);
        }

        $user = new User();
        $user->updateUserController($id);
    }

    function deleteUser()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $userModel = $this->model('UserModel');
            $userModel->deleteUser($id);
        } else {
            $this->Toast('error', 'Xoá thất bại.');
        }
    }
    function logout()
    {
        Session::destroy();
        header('location: /WEB2041_Ecommerce/account/login');
    }
    //End user action



    //Rating product
    function ratingProduct()
    {
        $prod = new Product();
        $prod->ratingController();
    }

    function deleteRatingProduct()
    {
        // if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        //     $id = $_POST['id'];
        //     $productModel = $this->model('ProductModel');
        //     $productModel->deleteRatingProduct($id) ?? [];
        // } else {
        //     $this->Toast('error', 'Xoá thất bại.');
        // }
    }
    //Rating product end

    //report
    function getProdForCateChart()
    {
        $productModel = $this->model('ProductModel');
        echo $productModel->getProdForCateChart() ?? [];
    }
    //report
}
