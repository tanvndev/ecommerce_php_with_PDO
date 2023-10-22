<?php

class Cart extends Controller
{
    private $cartModel;
    public function __construct()
    {
        $this->cartModel = $this->model('CartModel');
        // ViewShare::share($this->cartModel->getAllCart());
    }

    function Default()
    {
    }

    function getAllCart()
    {
        echo $this->cartModel->getAllCart();
    }

    function deleteCart($id)
    {
        echo $this->cartModel->deleteCart($id);
    }
    function updateQuantity($id, $action)
    {
        echo $this->cartModel->updateQuantity($id, $action);
    }
    function addCart($idProd)
    {
        echo $this->cartModel->addNewProductCart($idProd);
    }
}
