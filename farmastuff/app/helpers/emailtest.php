<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../../../libraries/phpmailer/src/Exception.php');
require_once('../../../libraries/phpmailer/src/PHPMailer.php');
require_once('../../../libraries/phpmailer/src/SMTP.php'); 
require_once('../../../libraries/phpmailer52/class.smtp.php'); 

$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

$codigo = generate_string($permitted_chars, 5);
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug  = 2;
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
    $mail->Subject = 'FarmaStuff codigo de confirmacion '.$codigo;
    $mail->Body    = 'Hola, le saludamos de FarmaStuff, le enviamos este correo para corroborar su usuario. 
    Su código de seguridad es: <h2>'.$codigo.'</h2>'.' 
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