<?php
require '../vendor/PHPMailer/Exception.php';
require '../vendor/PHPMailer/PHPMailer.php';
require '../vendor/PHPMailer/SMTP.php';
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_email_to($destination_email, $link, $page) {
  $mail = new PHPMailer(true);
  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = EMAIL_NAME;                     // SMTP username
    $mail->Password   = EMAIL_PASSWORD;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom(EMAIL_NAME, 'Tri Son Nguyen');
    $mail->addAddress($destination_email);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    if ($page == "active") {
        $html_content = file_get_contents('mail/email_verification.html');
        $html_content = preg_replace('/{link}/', $link, $html_content);

        // get plain email content
        $plain_text = file_get_contents('mail/email_verification.txt');
        $plain_text = preg_replace('/{link}/', $link, $plain_text);
    }
    else if ($page == "reset") {
        $html_content = file_get_contents('mail/reset_password.html');
        $html_content = preg_replace('/{link}/', $link, $html_content);

        // get plain email content
        $plain_text = file_get_contents('mail/reset_password.txt');
        $plain_text = preg_replace('/{link}/', $link, $plain_text);
    }


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your account has been created';
    $mail->Body    = $html_content;
    $mail->AltBody = $plain_text;

    $mail->send();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

?>
