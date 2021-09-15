<?php
//Se incluye la clase con las plantillas del documento
include('private/loginPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Login');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 

require_once('../../../libraries/phpmailer/src/Exception.php');
require_once('../../../libraries/phpmailer/src/PHPMailer.php');
require_once('../../../libraries/phpmailer/src/SMTP.php'); 
require_once('../../../libraries/phpmailer52/class.smtp.php'); 


$correo = $_POST['correo_empleados'];
$codigos = $_POST['codigosenviar'];
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail ->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true    
        ));    
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'farmastuff.devteam@gmail.com';                     //SMTP username
    $mail->Password   = 'NNo00081670%#';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;             //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom('farmastuff.devteam@gmail.com', 'FarmaStuff Security Department');
    $mail->addAddress($correo);     //Add a recipient
    
    //Attachments    
    //$mail->addAttachment('../../resources/img/Originals/logoconpng.png', 'new.jpg');    //Optional name

    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = utf8_decode('Envío de código para recuperación de contraseñas');
    $mail->Body    = 'Este es su código de recuperación para su contraseña:   '.$codigos;

    //Send Email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>