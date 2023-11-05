<?php

class Cart extends Controller
{
    private $cartModel;
    private $user_id = null;
    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
        $this->user_id = ViewShare::$dataShare['userData']['user_id'] ?? '';
        // ViewShare::share($this->cartModel->getAllCart());
    }

    function Default()
    {
    }

    function getAllCartApi()
    {
        if (empty($this->user_id)) {
            echo json_encode([]);
            return;
        }

        $dataCart = $this->cartModel->getAllCart($this->user_id);

        if (empty($dataCart)) {
            echo json_encode([]);
            return;
        }

        echo json_encode($dataCart);
        return;
    }

    function addCartApi($idProd)
    {
        echo $this->cartModel->addNewProductCart($idProd);
    }

    function deleteCartApi($id)
    {
        echo $this->cartModel->deleteCart($id);
    }
    function updateQuantityApi($id, $action)
    {
        echo $this->cartModel->updateQuantity($id, $action);
    }
}
