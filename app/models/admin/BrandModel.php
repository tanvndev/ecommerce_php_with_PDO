<?php
class BrandModel extends DB
{
    use CRUD;
    use SweetAlert;
    function getAllBrand()
    {
        return $this->find('brand');
    }

    function getOneBrand($id)
    {
        return $this->findById('brand', $id);
    }


    function addNewBrand()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';

            if (empty($name)) {
                $this->Toast('error', 'Vui lòng không để trống.');
                return;
            }

            try {
                $sql = 'INSERT INTO brand (name) VALUES (?)';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    $name
                ]);

                Session::set('deleteMessage', 'Thêm thành công.');
                Session::set('deleteType', 'success');
            } catch (PDOException $e) {
                Session::set('deleteMessage', 'Thêm thất bại.');
                Session::set('deleteType', 'error');
                echo "Error: " . $e->getMessage();
            }
            header('Location: /WEB2041_Ecommerce/admin/brand');
        }
    }


    function updateBrand($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';

            if (empty($name)) {
                $this->Toast('error', 'Vui lòng không để trống.');
                return;
            }

            try {
                $sql = 'UPDATE brand SET name=? WHERE id=?';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$name, $id]);
                Session::set('deleteMessage', 'Cập nhập thành công.');
                Session::set('deleteType', 'success');
                header('Location: /WEB2041_Ecommerce/admin/brand');
            } catch (PDOException $e) {
                Session::set('deleteMessage', 'Cập nhập thất bại.');
                Session::set('deleteType', 'error');
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function deleteBrand($id)
    {
        $success = $this->deleteById('brand', $id);

        if ($success) {
            Session::set('deleteMessage', 'Xoá thành công.');
            Session::set('deleteType', 'success');
            header('Location: /WEB2041_Ecommerce/admin/brand');
            return true;
        }

        Session::set('deleteMessage', 'Xoá thất bại.');
        Session::set('deleteType', 'error');
        return false;
    }
}
