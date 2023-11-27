<?php
class UserModel extends BaseModel
{

    use SweetAlert;
    function getAllUser()
    {
        return $this->find('user');
    }

    function getOneUser($id)
    {
        return $this->findById('user', $id);
    }

    function countUser()
    {
        return $this->countColumn('user', 'role = 2');
    }



    function addNewUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $re_password = $_POST['re_password'] ?? '';
            $role = $_POST['role'] ?? '';

            if (empty($fullname) || empty($email) || empty($password)) {
                $this->Toast('error', 'Vui lòng không để trống.');
                return;
            }

            $checkEmail = $this->checkIdentificationExisted($email, 'email', 'Email has existed.');
            if (!$checkEmail) {
                return;
            };

            if ($password !== $re_password) {
                $this->Toast('error', 'Mật khẩu không khớp.');
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            try {
                $sql = 'INSERT INTO user (fullname, email, password, role) VALUES (?, ?, ?, ?)';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    $fullname, $email, $hashedPassword, $role
                ]);
                $this->Toast('success', 'Add new user success.', 'admin/user', 1000);
            } catch (PDOException $e) {
                $this->Toast('error', 'Add new user failed.');
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function updateUser($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $password = $_POST['password'] ?? '';
            $re_password = $_POST['re_password'] ?? '';
            $role = $_POST['role'] ?? '';
            $isBlock = $_POST['isBlock'] ?? '';
            $avatar = $_FILES['avatar'] ?? '';


            $isSuccess = false;


            if (empty($fullname) || empty($email) || empty($password) || empty($phone)) {
                $this->Toast('error', 'Vui lòng không để trống.');
                return;
            }

            $checkIdentifiExisted = $this->findById('user', $id);

            if ($checkIdentifiExisted['email'] != $email &&  $checkIdentifiExisted['email'] == $email) {
                $this->Toast('error', 'Email đã tồn tại.');
                return;
            }

            if ($checkIdentifiExisted['phone'] != $phone && $checkIdentifiExisted['phone'] == $phone) {
                $this->Toast('error', 'Số điện thoại đã tồn tại.');
                return;
            }

            $pattern = '/^(0[1-9]\d{8,9})$/';
            if (!preg_match($pattern, $phone)) {
                $this->Toast('error', 'Số điện thoại không hợp lệ.');
                return;
            }


            if ($checkIdentifiExisted['password'] == $password) {
                $hashedPassword = $password;
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            }


            if ($password !== $re_password) {
                $this->Toast('error', 'Mật khẩu không khớp.');
                return;
            }




            try {
                if (!empty($avatar['name'])) {
                    $imageName = $this->uploadSingleImage($avatar, 'users');
                    if ($imageName) {
                        $sql = 'UPDATE user SET fullname=?, email=?, phone=?, address=?, password=?, role=?, isBlock=?, avatar=?, update_At=NOW() WHERE id=?';
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute([$fullname, $email, $phone, $address, $hashedPassword, $role, $isBlock, $imageName, $id]);
                        $isSuccess = true;
                    }
                } else {
                    $sql = 'UPDATE user SET fullname=?, email=?, phone=?, address=?, password=?, role=?, isBlock=?, update_At=NOW() WHERE id=?';
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([$fullname, $email, $phone, $address, $hashedPassword, $role, $isBlock, $id]);
                    $isSuccess = true;
                }

                if ($isSuccess) {
                    $this->Toast('success', 'Cập nhập thành công.', 'admin/user', 1000);
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }



    function deleteUser($id)
    {
        $dataUser = $this->findById('user', $id);

        if ($dataUser['role' == 1]) {
            Session::set('toastMessage', 'Không thể xoá tài khoản admin.');
            Session::set('toastType', 'error');
            return false;
        }

        if (!empty($dataUser['image'])) {
            $imagePath = "public/images/users/" . $dataUser['avatar'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $success = $this->deleteById('user', $id);

        if ($success) {
            Session::set('toastMessage', 'Xoá thành công.');
            Session::set('toastType', 'success');
            header('Location: /WEB2041_Ecommerce/admin/user');
            return true;
        }

        Session::set('toastMessage', 'Xoá thất bại.');
        Session::set('toastType', 'error');

        return false;
    }
}
