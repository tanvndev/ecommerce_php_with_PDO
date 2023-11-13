<?php
class Account extends Controller
{
    use SweetAlert;

    private $req = null;
    private $res = null;
    private $userModel;

    public function __construct()
    {
        $this->req = new Request;
        $this->res = new Response;
        $this->userModel = $this->model('UserModel');
    }

    function Default()
    {
        header('location: /WEB2041_Ecommerce/account/login');
    }


    function checkIdentificateExistedApi()
    {
        if ($this->req->isPost()) {
            $dataPost = $this->req->getFields();
            $data = $this->userModel->checkEmailExistedApi($dataPost['email']);
            echo json_encode($data);
            return;
        }
    }

    function checkStrongPasswordApi()
    {
        if ($this->req->isPost()) {
            $dataPost = $this->req->getFields();
            $isCheckPass = Format::isStrongPassword($dataPost['password']);
            echo json_encode($isCheckPass ? ['code' => 200] : ['code' => 400]);
        }
    }

    // Login
    public function login()
    {
        $dataValueOld = [];
        $type = 'error';

        if (!$this->req->isPost()) {
            $toatMessage = Session::get('toastMessage');
            $toastType = Session::get('toastType');
            $this->ToastSession($toatMessage, $toastType);
            return $this->renderLoginPage($dataValueOld);
        }

        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        //Set rule
        $this->req->rules([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Set message
        $this->req->message([
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->renderLoginPage($dataValueOld);
        }

        //Kiem tra email co ton tai
        $isEmailExisted = $this->userModel->checkEmailExisted($dataPost['email']);

        if (empty($isEmailExisted)) {
            $this->Toast($type, 'Email hoặc mật khẩu không chính xác.');
            return $this->renderLoginPage($dataValueOld);
        }

        // Neu tai khoan bi khoa se hien thi loi
        if ($isEmailExisted['isBlock'] !== 0) {
            $this->Toast($type, 'Tài khoản của bạn đã bị khoá.');
            return $this->renderLoginPage($dataValueOld);
        }

        // Check password
        if (password_verify($dataPost['password'], $isEmailExisted['password'])) {
            $userData = [
                'user_id' => $isEmailExisted['id'],
                'role_id' => $isEmailExisted['role_id'],
                'fullname' => $isEmailExisted['fullname'],
                'isBlock' => $isEmailExisted['isBlock'],
            ];

            if (!empty($isEmailExisted['avatar'])) {
                $userData['avatar'] = $isEmailExisted['avatar'];
            }

            // Create token
            $accessToken = JWT::createJWT($userData, (2 * 3600)); // 2h
            $refreshToken = JWT::createJWT(['refreshToken' => $isEmailExisted['id']], (7 * 24 * 3600)); //7 day

            $dataToken = [
                'accessToken' => $accessToken,
                'refreshToken' => $refreshToken,
                'update_at' => date('Y-m-d H:i:s'),
            ];

            //Update token
            if ($this->userModel->updateToken($isEmailExisted['id'], $dataToken)) {
                Session::set('userLogin', $accessToken);
                Cookie::set('keepLogin', $refreshToken, 7 * 24 * 3600);

                $redirectUrl = ($isEmailExisted['role_id'] == 1) ? 'admin' : 'home';
                $this->Alert('Đăng nhập thành công.', 'success', $redirectUrl, 1200);
                return $this->renderLoginPage($dataValueOld);
            } else {
                $this->Toast('error', 'Có lỗi vui lòng đăng nhập lại.');
                return $this->renderLoginPage($dataValueOld);
            }
        }
    }
    private function renderLoginPage($dataValueOld = [])
    {

        $this->view('layoutLogin', [
            'title' => 'Đăng nhập',
            'pages' => 'account/login',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }
    // End Login

    // Register
    function register()
    {
        if ($this->req->isPost()) {
            $dataValueOld = $this->req->getFields();
        }
        $this->view('layoutLogin', [
            'title' => 'Đăng ký',
            'pages' => 'account/register',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }
    function registerApi()
    {
        $type = 'error';
        $dataPost = $this->req->getFields();

        //Set rule
        $this->req->rules([
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required|strong',
        ]);

        // Set message
        $this->req->message([
            'fullname.required' => 'Vui lòng không để trống họ và tên.',
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'password.required' => 'Vui lòng không để trống mật khẩu.',
            'password.strong' => 'Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            echo json_encode([$type => reset($dataError)]);
            return;
        }

        //Kiem tra email co ton tai
        $isEmailExisted = $this->userModel->checkEmailExisted($dataPost['email']);
        if (!empty($isEmailExisted)) {
            echo json_encode([$type => 'Email đã tồn tại vui lòng đăng nhập.']);
            return;
        }

        //Bam mat khau
        $hashedPassword = password_hash($dataPost['password'], PASSWORD_BCRYPT);

        //Tao token
        $token = Format::generateRandomString(64);
        $subject = 'Xác nhận đăng ký.';
        $body = 'Click vào đây để hoàn thành đăng ký của bạn: <a href="http://localhost/WEB2041_Ecommerce/signup-comfirm/' . $token . '">Xác nhận</a> Đường dẫn sẽ hết hạn trong 15 phút.';

        // luu tam du lieu vao cookie truoc khi xac nhan
        $tempUser = array(
            'email' => $dataPost['email'],
            'fullname' => $dataPost['fullname'],
            'password' => $hashedPassword,
            'token' => password_hash($token, PASSWORD_BCRYPT)
        );
        //gui mail
        $sendMail = Services::sendCode($dataPost['email'], $subject,  $body);

        //gui thanh cong
        if ($sendMail) {
            Cookie::set('tempUser', json_encode($tempUser));
            echo json_encode(['success' => 'Vui lòng xác nhận email để hoàn tất đăng ký.']);
            return;
        }

        echo json_encode(['error' => 'Đã có lỗi sảy ra vui lòng đăng ký lại.']);
        return;
    }
    function finalRegisterUser($token)
    {

        $dataSuccess = [
            'icon' => 'check',
            'h1' => 'Xác nhận đăng ký thành công.',
            'h5' => 'Xác nhận đăng ký thành công vui lòng đăng nhập.'

        ];
        $dataError = [
            'icon' => 'times',
            'h1' => 'Xác nhận đăng ký thất bại.',
            'h5' => 'Đường link xác nhận đã hết hạn vui lòng đăng ký lại.'
        ];

        //Lay du lieu tu cookie da luu tu buoc tren
        $tempUser = json_decode(Cookie::get('tempUser'), true);

        //Xac nhan neu khong dung thi hien data loi
        if (empty($tempUser) || !password_verify($token, $tempUser['token'])) {

            return $this->view('layoutLogin', [
                'title' => 'Xác nhận đăng ký',
                'pages' => 'account/activeAccount',
                'dataRegister' => $dataError ?? []
            ]);
        }

        //Neu dung thi them du lieu tai khoan vao database
        $dataInsert = ['email' => $tempUser['email'], 'fullname' => $tempUser['fullname'], 'password' => $tempUser['password']];

        $success = $this->db->create('user', $dataInsert);
        if ($success) {
            Cookie::unsetCookie('tempUser');
            return $this->view('layoutLogin', [
                'title' => 'Xác nhận đăng ký',
                'pages' => 'account/activeAccount',
                'dataRegister' => $dataSuccess ?? []
            ]);
        } else {
            Cookie::unsetCookie('tempUser');
            return $this->view('layoutLogin', [
                'title' => 'Xác nhận đăng ký',
                'pages' => 'account/activeAccount',
                'dataRegister' => $dataError ?? []
            ]);
        }
    }
    // End Register

    // forgot Password
    function forgotPassword()
    {
        $this->view('layoutLogin', [
            'title' => 'Quên mật khẩu',
            'pages' => 'account/forgotPassword'
        ]);
    }

    function forgotPasswordApi()
    {
        $type = 'error';
        $dataPost = $this->req->getFields();

        //Set rule
        $this->req->rules([
            'email' => 'required|email',
        ]);

        // Set message
        $this->req->message([
            'email.required' => 'Vui lòng không để trống email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
        ]);

        //Start validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            echo json_encode([$type => reset($dataError)]);
            return;
        }

        //Kiem tra email co ton tai
        $isEmailExisted = $this->userModel->checkEmailExistedApi($dataPost['email']);
        if ($isEmailExisted['code'] == 400) {
            echo json_encode([$type => 'Email không tồn tại vui lòng đăng ký.']);
            return;
        }

        // Create token
        $token = Format::generateRandomString(64);
        $subject = 'Đặt lại mật khẩu.';
        $body = 'Click vào đây để xác nhận email của bạn: <a href="http://localhost/WEB2041_Ecommerce/account/finalForgotPassword/' . $token . '">Xác nhận</a> Đường dẫn sẽ hết hạn trong 15 phút.';


        //Send mail
        $sendMail = Services::sendCode($dataPost['email'], $subject,  $body);

        //Set data with cookie
        $dataResetPassword = [
            'email' => $dataPost['email'],
            'token' => password_hash($token, PASSWORD_BCRYPT)
        ];

        if ($sendMail) {
            Cookie::set('resetPassword', json_encode($dataResetPassword));
            echo json_encode(['success' => 'Vui lòng xác nhận email để đổi mật khẩu.']);
            return;
        }
    }



    function finalForgotPassword($token)
    {
        $resetPasswordToken = json_decode(Cookie::get('resetPassword'), true);

        if (empty($resetPasswordToken) && !password_verify($token, $resetPasswordToken['token'])) {
            Session::set('toastMessage', 'Đường link xác nhận đã hết hạn vui lòng thực hiện lại.');
            Session::set('toastType', 'error');
            Cookie::unsetCookie('resetPassword');
            return $this->res->redirect('login');
        }
        return $this->res->redirect('reset-password');
    }


    function resetPassword()
    {
        $resetPasswordToken = json_decode(Cookie::get('resetPassword'), true);
        //Kiem tra co cookie khong
        if (empty($resetPasswordToken) || !isset($resetPasswordToken['email']) || !isset($resetPasswordToken['token'])) {
            Session::set('toastMessage', 'Đường link xác nhận đã hết hạn vui lòng thực hiện lại.');
            Session::set('toastType', 'error');
            Cookie::unsetCookie('resetPassword');
            return $this->res->redirect('login');
        }

        $type = 'error';
        $dataPost = $this->req->getFields();
        $dataValueOld = $dataPost;

        if (!$this->req->isPost()) {
            return $this->renderResetPasswordPage($dataValueOld);
        }

        //Set rule
        $this->req->rules([
            'password' => 'required|strong',
            're_password' => 'match:password',
        ]);

        // Set message
        $this->req->message([
            'password.required' => 'Vui lòng không để trống mật khẩu.',
            'password.strong' => 'Độ dài tối thiểu là 8 ký tự, và phải bao gồm chữ hoa, chữ thường, chữ số và ký tự đặc biệt.',
            're_password.match' => 'Mật khẩu chưa khớp vui lòng thử lại.',
        ]);

        //Bat dau validate
        $this->req->validate();
        $dataError = $this->req->errors();
        // Neu co loi validate se hien loi
        if (!empty($dataError)) {
            $this->Toast($type, reset($dataError));
            return $this->renderResetPasswordPage($dataValueOld);
        }

        $dataUpdate = [
            'email' => $resetPasswordToken['email'],
            'password' => password_hash($dataPost['password'], PASSWORD_BCRYPT),
            'update_at' => date('Y-m-d H:i:s'),
        ];
        // Update
        $updatePass = $this->userModel->updatePassword($resetPasswordToken['email'], $dataUpdate);

        //Handle thong bao
        if ($updatePass) {
            Cookie::unsetCookie('resetPassword');
            $this->Alert('Đặt lại mật khẩu thành công vui lòng đăng nhập.', 'success', 'login');
            return $this->renderResetPasswordPage($dataValueOld);
        } else {
            Session::set('toastMessage', 'Đặt lại mật khẩu thất bại vui lòng thực hiện lại.');
            Session::set('toastType', 'error');
            Cookie::unsetCookie('resetPassword');
            return $this->res->redirect('login');
        }
    }

    private function renderResetPasswordPage($dataValueOld)
    {
        $this->view('layoutLogin', [
            'title' => 'Đặt lại mật khẩu',
            'pages' => 'account/resetPassword',
            'dataValueOld' => $dataValueOld ?? [],
        ]);
    }
    // End forgot Password
    function logout()
    {
        Session::destroy();
        Cookie::unsetCookie('keepLogin');
        header('location: /WEB2041_Ecommerce/');
    }
}
