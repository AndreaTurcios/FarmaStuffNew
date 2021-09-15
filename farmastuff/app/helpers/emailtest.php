<?php
include('private/loginPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Login');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('../../libraries/phpmailer/src/Exception.php');
require_once('../../libraries/phpmailer/src/PHPMailer.php');
require_once('../../libraries/phpmailer/src/SMTP.php'); 
require_once('../../libraries/phpmailer52/class.smtp.php'); 
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    session_start();
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug  = 0;
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'farmastuffsv@gmail.com';                     //SMTP username
    $mail->Password   = 'ftmztvmtmbyoftxb';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;                                 
    $mail->setFrom('farmastuffsv@gmail.com');
    $mail->addAddress($_SESSION['correo']); 
    $mail->isHTML(true);         
    $mail->Subject = 'FarmaStuff codigo de confirmacion '.$_SESSION['codigoo']
    $mail->Body    = 'Hola, le saludamos de FarmaStuff, le enviamos este correo para corroborar su usuario. 
    Su código de seguridad es: <h2>'.$_SESSION['codigoo'].'</h2>'.' 
    --
    <br><p>
    𝕔 FarmaStuff - 2021, El Salvador';
    $mail->AltBody = '𝕔 FarmaStuff - 2021, El Salvador';

    $mail->send();
    echo 'El mensaje se ha enviado correctamente';
} catch (Exception $e) {
    echo "El mensaje no se ha podido enviar. Mailer Error: {$mail->ErrorInfo}";
}
?>