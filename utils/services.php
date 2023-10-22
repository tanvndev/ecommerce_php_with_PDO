<?php
require 'vendors/PHPMailer/src/PHPMailer.php';
require 'vendors/PHPMailer/src/SMTP.php';
require 'vendors/PHPMailer/src/Exception.php';
require 'vendors/PHPMailer/language/phpmailer.lang-vi.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Services
{
    // Cấu hình thông tin email
    private static $smtpHost = 'smtp.gmail.com';
    private static $smtpUsername = 'vungoctan.vnt63@gmail.com';
    private static $smtpPassword = 'zgwmfskhiwupqysl';
    private static $smtpPort = 587; // Hoặc cổng 465 


    // Gửi mã xác nhận qua email
    static function sendCode($email, $subject, $body)
    {

        $mail = new PHPMailer(true);

        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->setLanguage('vi', '../assets/library/PHPMailer/language/');
            $mail->CharSet = 'UTF-8';
            $mail->Host       = self::$smtpHost;
            $mail->SMTPAuth   = true;
            $mail->Username   = self::$smtpUsername;
            $mail->Password   = self::$smtpPassword;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Hoặc PHPMailer::ENCRYPTION_SMTPS nếu sử dụng 465
            $mail->Port       = self::$smtpPort;


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
