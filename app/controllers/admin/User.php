<?php
class User extends Controller
{
    use SweetAlert;
    private $userModel;
    private $req = null;

    function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->req = new Request;
    }
    function Default()
    {

        if (!$this->req->isPost()) {
            $toastMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toastMessage, $toastType);
        }
        $dataUserAd = $this->userModel->getAllUser() ?? [];

        $this->view('layoutServer', [
            'title' => 'Danh sách người dùng',
            'active' => 'user',
            'pages' => 'user/user',
            'dataUserAd' => $dataUserAd,

        ]);
    }


    function addUser()
    {
        $dataValueOld = [];
        $type = 'error';
        if (!$this->req->isPost()) {
            return $this->renderAddPage($dataValueOld);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Set rule
        $this->req->rules([
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            're_password' => 'match:password',
        ]);

        // Set message
        $this->req->message([
            'fullname.required' => 'Vui lòng không để trống họ tên.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
            're_password.match' => 'Mật khẩu chưa khớp.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->renderAddPage($dataValueOld);
        }

        //Kiem tra email co ton tai
        $isEmailExisted = $this->userModel->checkEmailExisted($dataPost['email']);

        if (!empty($isEmailExisted)) {
            $this->Toast($type, 'Email đã tồn tại.');
            return $this->renderAddPage($dataValueOld);
        }

        //Bam mat khau
        $hashedPassword = password_hash($dataPost['password'], PASSWORD_BCRYPT);

        // Them vao database
        $dataInsert =  [
            'fullname' => $dataPost['fullname'],
            'email' => $dataPost['email'],
            'password' => $hashedPassword,
            'role_id' => $dataPost['role_id'],
        ];

        $success = $this->db->create('user', $dataInsert);
        if ($success) {
            Session::set('toastMessage', 'Thêm mới thành công.');
            Session::set('toastType', 'success');
            header('location: /WEB2041_Ecommerce/admin/user');
            return;
        } else {
            $this->Toast($type, 'Thêm mới thất bại vui lòng thử lại.');
            return $this->renderAddPage($dataValueOld);
        }
    }

    private function renderAddPage($dataValueOld = [])
    {
        $this->view('layoutServer', [
            'title' => 'Thêm người dùng',
            'active' => 'user',
            'pages' => 'user/addUser',
            'dataValueOld' => $dataValueOld,
        ]);
    }

    function updateUser($id)
    {
        $dataUserUp = $this->userModel->getOneUser($id) ?? [];
        $type = 'error';
        if (!$this->req->isPost()) {
            return $this->renderUpdatePage($dataUserUp);
        }
        //Get data post
        $dataPost = $this->req->getFields();
        $avatar = $_FILES['avatar'];
        //Set rule
        $this->req->rules([
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|phone',
            'password' => 'required',
            're_password' => 'match:password',
        ]);

        // Set message
        $this->req->message([
            'fullname.required' => 'Vui lòng không để trống họ tên.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'phone.required' => 'Vui lòng không để trống số điện thoại.',
            'phone.phone' => 'Vui lòng nhập đúng phone.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
            're_password.match' => 'Mật khẩu chưa khớp.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->renderUpdatePage($dataUserUp);
        }


        // Neu nguoi email khac voi input nguoi dung vua nhap thi se kiem tra ton tai hay khong? neu khong thi se kh kiem tra
        if ($dataUserUp['email'] != $dataPost['email'] &&  $dataUserUp['email'] == $dataPost['email']) {
            $this->Toast($type, 'Email đã tồn tại.');
            return $this->renderUpdatePage($dataUserUp);
        }

        if ($dataUserUp['phone'] != $dataPost['phone'] && $dataUserUp['phone'] == $dataPost['phone']) {
            $this->Toast($type, 'Số điện thoại đã tồn tại.');
            return $this->renderUpdatePage($dataUserUp);
        }


        //Kiem tra lai mat khau
        if ($dataUserUp['password'] == $dataPost['password']) {
            $hashedPassword = $dataPost['password'];
        } else {
            $hashedPassword = password_hash($dataPost['password'], PASSWORD_BCRYPT);
        }

        // Cap nhap vao database
        $dataUpdate =  [
            'fullname' => $dataPost['fullname'],
            'email' => $dataPost['email'],
            'phone' => $dataPost['phone'],
            'password' => $hashedPassword,
            'address' => $dataPost['address'] ?? '',
            'isBlock' => $dataPost['isBlock'],
            'role_id' => $dataPost['role_id'],
            'update_at' => date('Y-m-d H:i:s'),
        ];

        if (!empty($avatar['name'])) {
            //Get name after uploads image
            $imageName = Format::uploadSingleImage($avatar, 'users');
            if ($imageName['error']) {
                $this->Toast('error', $imageName['error']);
                return $this->renderUpdatePage($dataUserUp);
            }
            $dataUpdate['avatar'] = $imageName['success'];
        }

        $success = $this->userModel->updateUser($id, $dataUpdate);
        if ($success) {
            Session::set('toastMessage', 'Cập nhập thành công.');
            Session::set('toastType', 'success');
            header('location: /WEB2041_Ecommerce/admin/user');
            return;
        } else {
            $this->Toast($type, 'Cập nhập thất bại vui lòng thử lại.');
            return $this->renderUpdatePage($dataUserUp);
        }
    }
    private function renderUpdatePage($dataUserUp = [])
    {
        $this->view('layoutServer', [
            'title' => 'Cập nhập người dùng',
            'active' => 'user',
            'pages' => 'user/updateUser',
            'dataUserUp' => $dataUserUp
        ]);
    }

    function changeIsBlock()
    {
        if ($this->req->isPost()) {
            $dataPost = $this->req->getFields();
            $dataUpdate = [
                'update_at' => date('Y-m-d H:i:s'),
            ];
            $data = $this->userModel->getOneUser($dataPost['user_id']);
            if ($data['isBlock'] == 1) {
                $dataUpdate['isBlock'] = 0;
            } else {
                $dataUpdate['isBlock'] = 1;
            }

            $update = $this->userModel->updateUser($dataPost['user_id'], $dataUpdate);
            if ($update) {
                echo json_encode(['success' => 'Cập nhập thành công.']);
                return;
            } else {
                echo json_encode(['success' => 'Cập nhập thất bại.']);
                return;
            }
        }
        return json_encode([]);
    }

    function deleteUser()
    {
        if ($this->req->isPost()) {
            $dataPost = $this->req->getFields();

            if ($dataPost['role_id'] == 1) {
                Session::set('error', 'Bạn không có quyền xoá ADMIN.');
                Session::set('toastType', 'error');
                header('location: /WEB2041_Ecommerce/admin/user');
                return;
            }
            $success =  $this->userModel->deleteUser($dataPost['id']);
            if ($success) {
                Session::set('toastMessage', 'Xoá thành công.');
                Session::set('toastType', 'success');
                header('location: /WEB2041_Ecommerce/admin/user');
                return;
            }
            Session::set('toastMessage', 'Xoá thất bại.');
            Session::set('toastType', 'error');
            header('location: /WEB2041_Ecommerce/admin/user');
            return;
        }
    }
}
