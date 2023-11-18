<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Cloudinary\Uploader;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class Services
{

    // Gửi mã xác nhận qua email
    static function sendCode($email, $subject, $body)
    {
        global $config;
        //Cau hinh config
        $configPhpMailer = $config['phpMailer'];

        $mail = new PHPMailer(true);

        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->setLanguage('vi', '../assets/library/PHPMailer/language/');
            $mail->CharSet = 'UTF-8';
            $mail->Host       = $configPhpMailer['smtpHost'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $configPhpMailer['smtpUsername'];
            $mail->Password   = $configPhpMailer['smtpPassword'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Hoặc PHPMailer::ENCRYPTION_SMTPS nếu sử dụng 465
            $mail->Port       = $configPhpMailer['smtpPort'];


            //thông tin người gửi và email nhận
            $mail->setFrom('no-reply@accounts.admin.com', 'Admin');
            $mail->addAddress($email);

            // Tiêu đề và nội dung email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Gửi email
            $mail->send();
            // echo 'Gửi thành email công.';
            return true;
        } catch (Exception $e) {
            // echo 'Gửi không thành công. Lỗi: ', $mail->ErrorInfo;
            return false;
        }
    }

    //Upload ảnh with cloudinary
    static function uploadImageToCloudinary($uploadedFile)
    {
        global $config;
        $configCloudinary = $config['cloudinary'];
        // Thiết lập cấu hình 
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $configCloudinary['cloud_name'],
                'api_key' => $configCloudinary['api_key'],
                'api_secret' => $configCloudinary['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Thực hiện tải lên ảnh lên Cloudinary
        try {
            $upload = new UploadApi();
            $uploadOptions = [
                'public_id' => '',
                'use_filename' => true,
                'overwrite' => true,
                'folder' => 'uploads_WEB2041_Ecommerce',
                'transformation' => [
                    ['format' => 'webp'],
                ],
            ];
            $result = $upload->upload($uploadedFile, $uploadOptions);

            return $result['secure_url'];
        } catch (\Exception $e) {
            return null;
        }
    }

    static function generateVnPayUrl($orderData)
    {
        global $config;
        $configVnpay = $config['bank']['vnpay'];

        if (empty($configVnpay)) {
            return false;
        }

        //Config
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/WEB2041_Ecommerce/payment-final";
        $vnp_TmnCode = $configVnpay['vnp_TmnCode'];
        $vnp_HashSecret = $configVnpay['vnp_HashSecret'];

        $time = time();
        $locale = 'vn';

        // Tạo một mảng chứa thông tin cần thiết
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $orderData['amount'] * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
            "vnp_Locale" => $locale,
            "vnp_OrderInfo" => 'vnpay_payment',
            "vnp_OrderType" => 'billpayment',
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $orderData['order_code'] . $time,
        );

        // Thêm thông tin nhưng không bắt buộc
        if (isset($orderData['bank_code']) && $orderData['bank_code'] != "") {
            $inputData['vnp_BankCode'] = $orderData['bank_code'];
        }

        if (isset($orderData['txt_bill_state']) && $orderData['txt_bill_state'] != "") {
            $inputData['vnp_Bill_State'] = $orderData['txt_bill_state'];
        }


        ksort($inputData);

        // Xây dựng chuỗi hash
        $hashdata = http_build_query($inputData, '', '&');

        $vnp_Url = $vnp_Url . "?" . $hashdata;

        // Thêm vnp_SecureHash vào URL nếu có vnp_HashSecret
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= '&vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    static function generateMomoUrl($orderData)
    {
        global $config;
        $configMomo = $config['bank']['momo'];

        if (empty($configMomo)) {
            return false;
        }

        //Config
        $momo_Url = "https://payment.momo.vn/gw_payment/transactionProcessor";
        $momo_Returnurl = "http://localhost/WEB2041_Ecommerce/home";
        $momo_PartnerCode = $configMomo['partner_code'];
        $momo_AccessKey = $configMomo['access_key'];
        $momo_SecretKey = $configMomo['secret_key'];

        $time = time();

        // Tạo một mảng chứa thông tin cần thiết
        $inputData = array(
            'partnerCode' => $momo_PartnerCode,
            'accessKey' => $momo_AccessKey,
            'requestId' => $orderData['order_id'] . $time,
            'amount' => $orderData['amount'],
            'orderId' => $orderData['order_id'],
            'orderInfo' => $orderData['order_desc'],
            'returnUrl' => $momo_Returnurl,
            'notifyUrl' => $momo_Returnurl, // Có thể cần điều chỉnh tùy thuộc vào yêu cầu của Momo
            'extraData' => 'merchantName=YourMerchantName',
        );

        ksort($inputData);

        // Xây dựng chuỗi hash
        $hashdata = implode('', $inputData) . $momo_SecretKey;
        $signature = hash('sha256', $hashdata);

        // Thêm chữ ký vào mảng dữ liệu
        $inputData['signature'] = $signature;

        // Tạo URL redirect
        $momo_Url .= '?' . http_build_query($inputData);

        return $momo_Url;
    }
}
