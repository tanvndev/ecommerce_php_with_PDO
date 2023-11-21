<?php

class Order extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    private $orderModel;
    function __construct()
    {
        $this->res = new Response;
        $this->checkRoleAdmin();

        $this->req = new Request;
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

        $dataOrder = $this->orderModel->getAllOrder();

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $this->view('layoutServer', [
            'active' => 'order',
            'title' => 'Danh sách đơn hàng',
            'pages' => 'order/order',
            'dataOrder' => $dataOrder ?? [],
        ]);
    }


    function orderDetail($idData)
    {
        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        // Lay ra id tu url
        $idDataArr = explode('-', $idData);

        // [0] => 10 order_id
        // [1] => 9 user_id
        // [2] => zFicq1700390884 order_code
        $order_id = reset($idDataArr);
        $user_id = $idDataArr[1];
        // $order_code = end($idDataArr);

        $dataOrder = $this->orderModel->getAllOrderItemByUser($user_id, $order_id);

        if (!empty($dataOrder)) {
            $dataOrderNew = [];
            foreach ($dataOrder as $item) {
                $idVariant = $item['product_variant_id'];
                if (!isset($dataOrderNew[$idVariant])) {
                    $dataOrderNew[$idVariant] = [
                        'product_variant_id' => $idVariant,
                        'title' => $item['title'],
                        'thumb' => $item['thumb'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'order_id' => $item['order_id'],
                        'order_date' => $item['order_date'],
                        'order_code' => $item['order_code'],
                        'fullname' => $item['fullname'],
                        'phone' => $item['phone'],
                        'address' => $item['address'],
                        'order_status_id' => $item['order_status_id'],
                        'total_money' => $item['total_money'],
                        'coupon_id' => $item['coupon_id'],
                        'sub_total' => $item['price'] * $item['quantity'],
                        'payment_method_name' => $item['payment_method_name'],
                        'attribute_values' => [$item['attribute_value']],

                    ];
                } else {
                    $dataOrderNew[$idVariant]['attribute_values'][] = $item['attribute_value'];
                }
            }

            foreach ($dataOrderNew as &$item) {
                $item['attribute_values'] = implode('-', $item['attribute_values']);
            }

            $dataOrderNew = array_values($dataOrderNew);
        }



        $this->view('layoutServer', [
            'active' => 'order',
            'title' => 'Chi tiết đơn hàng',
            'pages' => 'order/orderDetail',
            'dataOrder' => $dataOrderNew,
            'idData' => $idData,
        ]);
    }

    // Xu ly trang thai don hang
    function updateOrderStatus()
    {
        if (!$this->req->isPost()) {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại', 'admin/order');
        }

        $dataPost = $this->req->getFields();
        if (empty($dataPost['order_id']) || empty($dataPost['order_status_id']) || empty($dataPost['idData'])) {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại.', 'admin/order');
        }

        $updateStatus = $this->orderModel->updateOrder($dataPost['order_id'], [
            'order_status_id' => $dataPost['order_status_id']
        ]);

        if ($updateStatus) {
            return $this->res->setToastSession('success', 'Bạn đã cập nhập đơn hàng thành công.', 'admin/order-detail/' . $dataPost['idData']);
        } else {
            return $this->res->setToastSession('error', 'Có lỗi xảy ra vui lòng thử lại', 'admin/order-detail/' . $dataPost['idData']);
        }
    }
}
