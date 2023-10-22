<?php
class Product_AtrributeModel extends DB
{
    use CRUD;
    function getAllProduct_Atrribute()
    {
        return $this->find('product_attribute');
    }
}
