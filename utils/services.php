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
}
