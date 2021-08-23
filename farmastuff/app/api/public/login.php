<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/public/usuarioCliente.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuarioCliente = new usuarioCliente;                  
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['idcliente'])) {
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {
            
            case 'logOut':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión cerrada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
                break;
        }
    } else {
        // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'logIn':
                $_POST = $usuarioCliente->validateForm($_POST);
                if ($usuarioCliente->checkUser($_POST['usuariocliente'])) {
                    if ($usuarioCliente->checkPassword($_POST['clavecliente'])) {
                        $_SESSION['idcliente'] = $usuarioCliente->getId();
                        $_SESSION['usuariocliente'] = $usuarioCliente->getUsuarioCliente();
                        $_SESSION['correocliente'] = $usuarioCliente->getCorreoCliente();
                        $result['status'] = 1;
                        $result['message'] = 'Autenticación correcta';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Clave incorrecta';
                        }
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Alias incorrecto';
                    }                                            
                }
                break;
             
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
