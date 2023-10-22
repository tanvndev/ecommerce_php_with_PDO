<?php
class CategoryModel extends DB
{
    use CRUD;
    function getAllCategory()
    {
        return $this->find('category');
    }
}
