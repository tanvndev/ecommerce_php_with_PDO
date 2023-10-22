<?php
class Attributes extends Controller
{

    private $attributeModel;
    function __construct()
    {
        $this->attributeModel = $this->modelAdmin('AttributeModel');
    }

    function attributeController()
    {
        $delMassage = Session::get('deleteMessage');
        $delType = Session::get('deleteType');

        $dataAttribute = $this->attributeModel->getAllAttribute() ?? [];

        $this->view('layoutServer', [
            'title' => 'Danh sách thuộc tính',
            'active' => 'attributes',
            'pages' => 'attribute/attribute',
            'dataAttribute' => $dataAttribute,
            'delMessage' => $delMassage,
            'delType' => $delType
        ]);
    }

    function addAttributeController()
    {
        $this->view('layoutServer', [
            'active' => 'attributes',
            'title' => 'Thêm thuộc tính',

            'pages' => 'attribute/addAttribute'
        ]);
    }

    function updateAttributeController($id)
    {
        $dataAttribute = $this->attributeModel->getOneAttribute($id) ?? [];

        $this->view('layoutServer', [
            'active' => 'attributes',
            'pages' => 'attribute/updateAttribute',
            'title' => 'Cập nhập thuộc tính',

            'dataAttribute' => $dataAttribute
        ]);
    }

    function deleteAttributeController($id)
    {
        $this->attributeModel->deleteAttribute($id);
    }
}
