<?php

class DashBoard extends Controller
{

    use SweetAlert;
    private $req = null;
    private $res = null;
    private $productModel;
    private $userModel;
    private $categoryModel;
    private $storeCustom;
    private $orderModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->storeCustom = $this->model('StoreCustom');
        $this->userModel = $this->model('UserModel');
        $this->orderModel = $this->model('OrderModel');
    }

    private function checkRoleAdmin()
    {
        $accessToken = null;
        //Check accessToken
        if (!empty(Session::get('userLogin'))) {
            $accessToken = JWT::verifyJWT(Session::get('userLogin')) ?? '';
        } else {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }

        //check accessToken con han
        if (!empty($accessToken) && isset($accessToken['error'])) {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }

        $dataUserCurrent = $accessToken['payload'];
        if ($dataUserCurrent['role_id'] == 3) {
            return $this->res->setToastSession('error', 'Vui lòng đăng nhập tài khoản quản trị.', 'home');
        }
    }



    function Default()
    {

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $prodCount = $this->productModel->countProduct();
        $userCount = $this->userModel->countUser();

        $dataProdOrderBySold = $this->productModel->getAllProductOrderBySold();
        $dataProdAll = $this->productModel->getAllProduct();
        $dataRatingsProd = $this->productModel->getAllRatingDashboard() ?? [];
        $dataAmount = $this->orderModel->getAmountStatistical();

        $totalRevenue = 0;
        $totalSold = 0;
        foreach ($dataProdAll as $item) {
            $totalSold += $item['sold'];
        }
        foreach ($dataAmount as $itemAmount) {
            $totalRevenue += $itemAmount['total_amount'];
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
        $dataStoreCustom = $this->storeCustom->getAllStoreCustom();
        $dataBanner = $this->storeCustom->getAllBanner();
        $dataCate = $this->categoryModel->getAllCategory();
        if (!$this->req->isPost()) {
            return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
        }

        $dataPost = $this->req->getFields();

        //Get image
        $logo = $_FILES['logo'] ?? '';

        //Set rule
        $this->req->rules([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|phone',
            'email' => 'required|email',
            'open_time' => 'required',
            'title' => 'required',
            'description' => 'required',
            'cate_id' => 'required',
        ]);

        // Set message
        $this->req->message([
            'name.required' => 'Vui lòng không để trống tên cửa hàng.',
            'address.required' => 'Vui lòng không để trống địa chỉ.',
            'phone.required' => 'Vui lòng không để trống số điện thoại.',
            'phone.phone' => 'Vui lòng nhập đúng đúng số điện thoại.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng email.',
            'open_time.required' => 'Vui lòng không để trống giờ mở cửa.',
            'title.required' => 'Vui lòng không để trống tiêu đề banner.',
            'description.required' => 'Vui lòng không để trống mô tả banner.',
            'cate_id.required' => 'Vui lòng không để trống danh mục.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast('error', reset($dataError));
            return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
        }


        $dataStoreCustomUpdate = [
            'name' => $dataPost['name'],
            'address' => $dataPost['address'],
            'phone' => $dataPost['phone'],
            'email' => $dataPost['email'],
            'open_time' => $dataPost['open_time'],
        ];


        if (!empty($logo['name'])) {
            //  validate Upload image thumb
            if (!Format::validateUploadImage($logo)) {
                $this->Toast('error', 'Kiểm tra lại file upload.');
                return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
            }

            //upload anh len cloud
            $urlLogo = Services::uploadImageToCloudinary($logo['tmp_name']);
            if (empty($urlLogo)) {
                $this->Toast('error', 'Upload ảnh thất bại.');
                return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
            }
            $dataStoreCustomUpdate['logo'] = $urlLogo;
        }

        $updateStoreCustom = $this->storeCustom->updateStoreCustom($dataPost['store_id'], $dataStoreCustomUpdate);
        $updateBanner = $this->storeCustom->updateBanner($dataPost['banner_id'], [
            'title' => $dataPost['title'],
            'description' => $dataPost['description'],
            'cate_id' => $dataPost['cate_id'],
        ]);


        if ($updateStoreCustom && $updateBanner) {
            $this->Toast('success', 'Cập nhập thành công.');
            return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
        } else {
            $this->Toast('error', 'Cập nhập thất bại.');
            return $this->renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate);
        }
    }

    function renderStoreCustomPage($dataBanner, $dataStoreCustom, $dataCate)
    {
        $dataStoreCustom = $this->storeCustom->getAllStoreCustom();

        $this->view('layoutServer', [
            'title' => 'Tuỳ chỉnh cửa hàng',
            'active' => 'storeCustom',
            'pages' => 'storeCustom/storeCustom',
            'dataBanner' => $dataBanner,
            'dataStoreCustom' => $dataStoreCustom,
            'dataCate' => $dataCate,

        ]);
    }
}
