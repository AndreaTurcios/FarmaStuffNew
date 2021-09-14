<?php
class testEmail extends PHPMailer{

$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'farmastuffsv@gmail.com';
$mail->Password = 'jdcsiulxrqwyyqod';
$mail->setFrom('farmastuffsv@gmail.com', 'Your Name');
$mail->addReplyTo('farmastuffsv@gmail.com', 'Your Name');
$mail->addAddress('farmastuffsv@gmail.com', 'Receiver Name');
$mail->Subject = 'Testing PHPMailer';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->Body = 'This is a plain text message body';
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
} 
}
?>