<?php

namespace MailService;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Tải autoloader của Composer
require 'vendor/autoload.php';
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

define('USERNAME_EMAIL', 'nguyenvitas7@gmail.com'); // thay bằng email của bạn
define('PASSWORD_EMAIL', 'kbuz kbow ciyq wsnn'); // thay bằng mật khẩu của bạn
class MailService
{
    public static function send($to = 'nguyenvitas7@gmail.com', $from = 'nguyenvitas7@gmail.com', $sublect = 'notfication', $content = '')
    {
        try {
            $mail = new PHPMailer();
            // $mail->SMTPDebug = 2;                                 // Kích hoạt chế độ debug chi tiết
            $mail->isSMTP();                                      // Sử dụng SMTP để gửi mail
            $mail->Host = 'smtp.gmail.com';  // Đặt máy chủ SMTP chính và dự phòng
            $mail->SMTPAuth = true;                               // Kích hoạt xác thực SMTP
            $mail->Username = USERNAME_EMAIL;                 // Tên đăng nhập SMTP
            $mail->Password = PASSWORD_EMAIL;                           // Mật khẩu SMTP
            $mail->SMTPSecure = 'tls';                            // Sử dụng mã hóa TLS, cũng có thể dùng `ssl`
            $mail->Port = 587;                                    // Cổng TCP để kết nối
            $mail->CharSet = 'UTF-8';
            // Người nhận
            $mail->setFrom($to, 'akinu shop memo'); // Đặt email gửi đi và tên hiển thị
            $mail->addAddress($from);               // Thêm người nhận (tên tùy chọn)
            // $mail->addReplyTo('info@example.com', 'Information'); // Thêm email trả lời
            // $mail->addCC('cc@example.com'); // Thêm người nhận bản sao
            // $mail->addBCC('bcc@example.com'); // Thêm người nhận bản sao ẩn

            // Đính kèm tệp (Attachments)

            // Nội dung
            $mail->isHTML(true);                                  // Đặt định dạng email là HTML
            $mail->Subject = $sublect; // Chủ đề email
            $mail->Body    = $content; // Nội dung email
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi Mailer: {$mail->ErrorInfo}";
            return false;
        }
    }
}
