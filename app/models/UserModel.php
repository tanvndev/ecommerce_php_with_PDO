<?php
class UserModel extends DB
{
    use CRUD;
    use SweetAlert;
    function checkEmailExisted()
    {
        $email = $_POST['email'];
        $isHasEmail = $this->findByName('user', $email, 'email');
        if (!empty($isHasEmail)) {
            return json_decode('0');
        }
        return json_decode('1');
    }

    function checkStrongPassword()
    {
        $password = $_POST['password'];
        $isStrongPass = Format::isStrongPassword($password);
        if (!$isStrongPass) {
            return json_decode('0');
        }
        return json_decode('1');
    }

    function loginUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $this->Toast('error', 'Vui lòng không để trống.');
                return false;
            }

            $checkEmail = $this->findByName('user', $email, 'email');

            if ($checkEmail && password_verify($password, $checkEmail[0]['password'])) {
                $data = $checkEmail[0];

                if ($data['isBlock'] == 1) {
                    $this->Alert('Tài khoản của bạn đang bị khoá.', 'error');
                    return false;
                }
                $userData = [
                    'user_id' => $data['id'],
                    'role' => $data['role'],
                    'fullname' => $data['fullname'],
                    'isBlock' => $data['isBlock'],
                ];
                if (!empty($data['avatar'])) {
                    $userData['avatar'] = $data['avatar'];
                }


                $accessToken = JWT::createJWT($userData);

                $condition = 'id = ' . $data['id'];

                $updateAccessToken = $this->findByNameAndUpdate('user', ['accessToken' => $accessToken], $condition);

                if (!$updateAccessToken) {
                    $this->Alert('Đăng nhập thất bại', 'error');
                }

                Session::set('userLogin', $accessToken);

                $redirectUrl = ($data['role'] == 1) ? 'admin' : 'home';
                $this->Alert('Đăng nhập thành công.', 'success', $redirectUrl, 1200);

                return true;
            }

            $this->Alert('Email hoặc mật khẩu không chính xác.', 'error');
            return false;
        }
    }


    function registerUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'] ?? '';
            $fullname = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password) || empty($fullname)) {
                return json_encode(['error' => 'Vui lòng không để trống.']);
            }

            $checkEmail = $this->findByName('user', $email, 'email');

            if (!empty($checkEmail)) {
                return json_encode(['error' => 'Email đã được đăng ký vui lòng đăng nhập.']);
            };

            $isStrongPass = Format::isStrongPassword($password);

            if (!$isStrongPass) {
                return json_encode(['error' => 'Mật khẩu chưa đạt yêu cầu.']);
            }
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $token = Format::generateRandomString(64);
            $subject = 'Xác nhận đăng ký.';
            $body = 'Click vào đây để hoàn thành đăng ký của bạn: <a href="http://localhost/WEB2041_Ecommerce/account/finalRegisterUser/' . $token . '">Xác nhận</a> Đường dẫn sẽ hết hạn trong 15 phút.';

            $tempUser = array(
                'email' => $email,
                'fullname' => $fullname,
                'password' => $hashedPassword,
                'token' => password_hash($token, PASSWORD_BCRYPT)
            );
            $sendMail = Services::sendCode($email, $subject,  $body);

            if ($sendMail) {
                Cookie::set('tempUser', json_encode($tempUser));
                return json_encode(['success' => 'Vui lòng xác nhận email để hoàn tất đăng ký.']);
            }

            return json_encode(['error' => 'Đã có lỗi sảy ra vui lòng đăng ký lại.']);
        }
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
        $tempUser = json_decode(Cookie::get('tempUser'), true);


        if (empty($tempUser) || !password_verify($token, $tempUser['token'])) {
            return $dataError;
        }


        $dataInsert = ['email' => $tempUser['email'], 'fullname' => $tempUser['fullname'], 'password' => $tempUser['password']];

        $success = $this->create('user', $dataInsert);
        if ($success) {
            Cookie::unsetCookie('tempUser');
            return $dataSuccess;
        } else {
            Cookie::unsetCookie('tempUser');
            return $dataError;
        }
    }

    function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            if (empty($email)) {
                return json_encode(['error' => 'Vui lòng không để trống.']);
            }

            $checkEmail = $this->findByName('user', $email, 'email');
            if (empty($checkEmail)) {
                return json_encode(['error' => 'Email chưa được đăng ký.']);
            }

            $token = Format::generateRandomString(64);
            $subject = 'Đặt lại mật khẩu.';
            $body = 'Click vào đây để xác nhận email của bạn: <a href="http://localhost/WEB2041_Ecommerce/account/finalForgotPasswordApi/' . $token . '">Xác nhận</a> Đường dẫn sẽ hết hạn trong 15 phút.';


            $sendMail = Services::sendCode($email, $subject,  $body);

            $dataResetPassword = [
                'email' => $email,
                'token' => password_hash($token, PASSWORD_BCRYPT)
            ];

            if ($sendMail) {
                Cookie::set('resetPassword', json_encode($dataResetPassword));
                return json_encode(['success' => 'Vui lòng xác nhận email để đổi mật khẩu.']);
            }
        }
    }


    function finalForgotUser($token)
    {
        $resetPasswordToken = json_decode(Cookie::get('resetPassword'), true);

        if (empty($resetPasswordToken) && !password_verify($token, $resetPasswordToken['token'])) {
            Session::set('deleteMessage', 'Đường link xác nhận đã hết hạn vui lòng thực hiện lại.');
            Session::set('deleteType', 'error');
            Cookie::unsetCookie('resetPassword');
            return header('location: /WEB2041_Ecommerce/account/login');
        }
        return header('location: /WEB2041_Ecommerce/account/resetPassword');
    }
    function resetPassword($dataReset)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $password = $_POST['password'];
            $re_password = $_POST['re_password'];

            if (empty($password) || empty($re_password)) {
                return $this->Toast('error', 'Vui lòng không để trống.');
            }

            $isStrongPass = Format::isStrongPassword($password);
            if (!$isStrongPass) {
                return $this->Toast('error', 'Độ dài mật khẩu chưa đúng yêu cầu.');
            }

            if ($password !== $re_password) {
                return $this->Toast('error', 'Mật khẩu không khớp.');
            }

            $hashPass = password_hash($password, PASSWORD_BCRYPT);

            try {
                $sql = "UPDATE user SET password = ? WHERE email = ?";
                $stml = $this->conn->prepare($sql);
                $stml->execute([
                    $hashPass, $dataReset['email']
                ]);

                Cookie::unsetCookie('resetPassword');
                return $this->Toast('success', 'Đặt lại mật khẩu thành công.', 'account/login', 1200);
            } catch (PDOException $e) {
                Cookie::unsetCookie('resetPassword');
                return $this->Toast('error', 'Đặt lại mật khẩu thất bại.', 'account/login', 1200);
            }
        }
    }
}
