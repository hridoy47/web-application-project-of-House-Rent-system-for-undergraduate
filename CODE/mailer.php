<?php
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'hridoy537047@gmail.com';          // SMTP username
$mail->Password = '316384372Hr'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('hridoy537047@gmail.com', 'shaft');
$mail->addReplyTo('ishaafi2294@gmail.com', 'shaft');
$mail->addAddress('ishaafi2294@gmail.com');   // Add a recipient
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');
$mail->addAttachment('1.cpp');
$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Confirmation Mail</h1>';
$bodyContent .= '<p>Click this link to activate your account</b></p>';

$mail->Subject = 'Email from Localhost';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Sent Successful';
}
?>