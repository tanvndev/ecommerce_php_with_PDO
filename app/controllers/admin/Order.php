<?php

class Order extends Controller
{
    use SweetAlert;
    private $req = null;
    private $res = null;
    function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
    }
    function Default()
    {

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }

        $this->view('layoutServer', [
            'active' => 'order',
            'title' => 'Danh sách đơn hàng',
            'pages' => 'order/order',
            'dataCate' => $dataCate ?? [],
        ]);
    }


    function orderDetail()
    {
        $this->view('layoutServer', [
            'active' => 'order',
            'title' => 'Chi tiết đơn hàng',
            'pages' => 'order/orderDetail',
        ]);
    }
}
