<?php
class AttributeModel extends BaseModel
{

    use SweetAlert;
    public function tableName()
    {
        return 'attribute';
    }
    public function tableField()
    {
        return '*';
    }
    public function primaryKey()
    {
        return 'id';
    }
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

                Session::set('toastMessage', 'Thêm thành công.');
                Session::set('toastType', 'success');
            } catch (PDOException $e) {
                Session::set('toastMessage', 'Thêm thất bại.');
                Session::set('toastType', 'error');
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
                Session::set('toastMessage', 'Cập nhập thành công.');
                Session::set('toastType', 'success');
                header('Location: /WEB2041_Ecommerce/admin/attribute');
            } catch (PDOException $e) {
                Session::set('toastMessage', 'Cập nhập thất bại.');
                Session::set('toastType', 'error');
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function deleteAttribute($id)
    {
        $success = $this->deleteById('attribute', $id);

        if ($success) {
            Session::set('toastMessage', 'Xoá thành công.');
            Session::set('toastType', 'success');
            header('Location: /WEB2041_Ecommerce/admin/attribute');
            return true;
        }

        Session::set('toastMessage', 'Xoá thất bại.');
        Session::set('toastType', 'error');
        return false;
    }
}
