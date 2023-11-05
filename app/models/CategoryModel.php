<?php
class CategoryModel extends BaseModel
{
    function tableName()
    {
        return 'category';
    }
    function tableField()
    {
        return '*';
    }
    function primaryKey()
    {
        return 'id';
    }

    function getAllCategory()
    {
        return $this->db->table($this->tableName())->orderBy('id')->get();
    }

    function getOneCategory($id)
    {
        return $this->db->findById($this->tableName(), $this->tableField(), $id);
    }


    function addNewCategory($data)
    {
        return $this->db->create($this->tableName(), $data);
    }

    function updateCategory($id, $data)
    {
        return $this->db->findByIdAndUpdate($this->tableName(), $id, $data);
    }

    function deleteCategory($id)
    {
        // deleteCategory 
        $delCategory = $this->db->findIdAndDelete($this->tableName(), $id);

        //Get id product
        $dataProd = $this->db->table('product')->select('id')->where('cate_id', '=', $id)->getOne();

        if (empty($dataProd)) {
            return true;
        }
        // Delete product 
        $delProd = $this->db->findIdAndDelete('product', $dataProd['id']);

        // Delete product Image
        $delImageProd = $this->db->findAndDelete('images_product', ['prod_id' => $dataProd['id']]);

        if ($delCategory && $delProd && $delImageProd) {
            return true;
        }
        return false;
    }
}
