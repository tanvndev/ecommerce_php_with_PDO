<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
}
