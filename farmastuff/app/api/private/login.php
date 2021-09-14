<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/usuario.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new usuario;                  
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como cliente para realizar las acciones correspondientes.
    if (isset($_SESSION['idempleado'])) {
        // Se compara la acción a realizar cuando un cliente ha iniciado sesión.
        switch ($_GET['action']) {
            case 'logOut':
                if (session_destroy()) {
                    $result['status'] = 1;
                    $result['message'] = 'Sesión eliminada correctamente';
                } else {
                    $result['exception'] = 'Ocurrió un problema al cerrar la sesión';
                }
            break;
            case 'historial':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setUsuario($_POST['usuario'])) {
                    if ($usuario->setBrowser($_POST['databrowser'])) {
                        if ($usuario->setOs($_POST['dataos'])) {
                            if ($usuario->setFecha($_POST['datafecha'])) {
                                if ($usuario->createRowHistorial()) {
                                    $result['status'] = 1;                                    
                                } else {
                                    $result['exception'] = Database::getException();                                                        
                                }                                         
                         } else {
                          $result['exception'] = 'Fecha no reconocida';
                         }     
                       } else {
                        $result['exception'] = 'Sistema Operativo no recopilado';
                      }        
                    } else {
                      $result['exception'] = 'Buscador no recopilado';
                    }  
                } else {
                    $result['exception'] = 'usuario desconocido';
                }       
            break;
            case 'logIn':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->checkUser($_POST['usuario'])) {
                    if ($usuario->checkPassword($_POST['clave'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Autenticación correcta';
                        $_SESSION['idempleado'] = $usuario->getId();
                        $_SESSION['usuario'] = $usuario->getUsuario();
                        $_SESSION['correo'] = $usuario->getCorreoEmpleado();
                        $_SESSION['tipo'] = $usuario->getIDTipoEmpleado();
                        
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
                        $result['exception'] = 'error e';
                    } else {
                        $result['exception'] = 'Alias incorrecto';
                    }                                            
                }
            break;                
            default:
            $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
        // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
        switch ($_GET['action']) {
             
                case 'readAll':
                    if ($result['dataset'] = $usuario->readAll()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay usuarios registrados';
                        }               
                    }
                    break;
                    case 'logIn':
                        $_POST = $usuario->validateForm($_POST);
                        if ($usuario->checkUser($_POST['usuario'])) {
                            if ($usuario->checkPassword($_POST['clave'])) {
                                $result['status'] = 1;
                                $result['message'] = 'Autenticación correcta';
                                $_SESSION['idempleado'] = $usuario->getId();
                                $_SESSION['usuario'] = $usuario->getUsuario();
                                $_SESSION['correo'] = $usuario->getCorreoEmpleado();
                                $_SESSION['tipo'] = $usuario->getIDTipoEmpleado();
                                $_SESSION['tiempo_usuario'] = time();
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
                                $result['exception'] = 'error e';
                            } else {
                                $result['exception'] = 'Alias incorrecto';
                            }                                            
                        }
                    break; 
                    case 'sessionTime':
                        if((time() - $_SESSION['tiempo_usuario']) < 10){
                            $_SESSION['tiempo_usuario'] = time();
                        } else{
                           unset($_SESSION['idempleado'], $_SESSION['usuario'], $_SESSION['tiempo_usuario']);
                            $result['status'] = 1;
                            $result['message'] = 'Se ha cerrado la sesión por inactividad'; 
                        }
                    break;   
                    case 'autenticacion':
                        if ($empleados->setId($_POST['idempleado'])) {
                            if ($data = $empleados->readOne()) {
                                if ($empleados->setCodigo($_POST['codigo'])) {
                                    if ($empleados->autenticacion()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Empleado confirmado correctamente'; 
                                    } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Empleado inexistente';
                            }
                        } else {
                            $result['exception'] = 'Empleado inexistente';
                        }
                        } else {
                            $result['exception'] = 'Empleado incorrecto';
                        }
                        break;    
                                           
                    default:
                         $result['exception'] = 'Acción no disponible fuera de la sesión'; 
        }
        
require_once('../../helpers/emailtest.php');
$emailtest = new emailtest;
if (isset($_POST['codigo'])) {
        $result['message'] = 'Codigo enviado correctamente'; 
    }
}
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
    
} else {
    
}