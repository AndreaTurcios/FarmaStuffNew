
<?php
require_once('../../helpers/recuperacionmail.php');
                         //$recuperacionmail = new recuperacionmail;
                         if (isset($_POST['correo_empleados']) || isset($_POST['codigosenviar'])  ) {                                
                                 $result['message'] = 'Correo enviado correctamente'; 
                             }
?>                             