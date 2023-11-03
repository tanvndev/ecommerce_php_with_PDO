<?php
class AttributeModel extends DB
{
    use CRUD;
    use SweetAlert;
    function getAllAttribute()
    {
        return $this->find('attribute');
    }

    function getOneAttribute($id)
    {
        return $this->findById('attribute', $id);
    }

    function getAttributeByName($variant)
    {
        return $this->findByName('attribute', $variant, 'name');
    }

    function getAllProduct_Atrribute($id)
    {
        return $this->findByName('product_attribute', $id, 'prod_id');
    }


    function addNewAttribute()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $value = $_POST['value'] ?? '';

            if (empty($name) || empty($value)) {
                $this->Toast('error', 'Vui lòng không để trống.');
                return;
            }

            try {
                $sql = 'INSERT INTO attribute (name, value) VALUES (?,?)';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    $name,
                    $value
                ]);

                Session::set('deleteMessage', 'Thêm thành công.');
                Session::set('deleteType', 'success');
            } catch (PDOException $e) {
                Session::set('deleteMessage', 'Thêm thất bại.');
                Session::set('deleteType', 'error');
                echo "Error: " . $e->getMessage();
            }
            header('Location: /WEB2041_Ecommerce/admin/attribute');
        }
    }


    function updateAttribute($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $value = $_POST['value'] ?? '';


            if (empty($name) || empty($value)) {
                $this->Toast('error', 'Vui lòng không để trống.');
                return;
            }

            try {
                $sql = 'UPDATE attribute SET name=?, value=? WHERE id=?';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$name, $value, $id]);
                Session::set('deleteMessage', 'Cập nhập thành công.');
                Session::set('deleteType', 'success');
                header('Location: /WEB2041_Ecommerce/admin/attribute');
            } catch (PDOException $e) {
                Session::set('deleteMessage', 'Cập nhập thất bại.');
                Session::set('deleteType', 'error');
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function deleteAttribute($id)
    {
        $success = $this->deleteById('attribute', $id);

        if ($success) {
            Session::set('deleteMessage', 'Xoá thành công.');
            Session::set('deleteType', 'success');
            header('Location: /WEB2041_Ecommerce/admin/attribute');
            return true;
        }

        Session::set('deleteMessage', 'Xoá thất bại.');
        Session::set('deleteType', 'error');
        return false;
    }
}
