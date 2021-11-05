<?php

require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/edit_usuario.php');

if (isset($_GET['action'])) {
    session_start();
    $edit = new edit;
    $result = array('status' => 0, 'message' => null, 'exception' => null); 
    if (isset($_SESSION['idempleado'])) {
     switch ($_GET['action']) {   
            case 'readAll':
                if ($result['dataset'] = $edit->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay ningún empleado ingresado en la base de datos';
                    }
                }
                break;
                case 'search':
                    $_POST = $edit->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $edit->searchRows($_POST['search'])) {
                            $result['status'] = 1;
                            $rows = count($result['dataset']);
                            if ($rows > 1) {
                                $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                            } else {
                                $result['message'] = 'Solo existe una coincidencia';
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay coincidencias';
                            }
                        }
                    } else {
                        $result['exception'] = 'Ingrese un valor para buscar';
                    }
                    break;
                    case 'readOne':
                        if ($edit->setId($_POST['idvaloracion'])) {
                            if ($result['dataset'] = $edit->readOne()) {
                                $result['status'] = 1;
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'No existe el respectivo empleado';
                                }
                            }
                        } else {
                            $result['exception'] = 'Empleado erróneo';
                        }
                        break;
                        case 'ocultar':
                            if ($edit->setId($_POST['idvaloracion'])) {
                                if ($data = $edit->readOne()) {
                                    if ($edit->ocultar()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Empleado eliminado correctamente'; 
                                       
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Empleado inexistente';
                                }
                            } else {
                                $result['exception'] = 'Proveedor incorrecto';
                            }
                            break; 
                            case 'mostrar':
                                if ($edit->setId($_POST['idvaloracion'])) {
                                    if ($data = $edit->readOne()) {
                                        if ($edit->mostrar()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Empleado eliminado correctamente'; 
                                           
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Empleado inexistente';
                                    }
                                } else {
                                    $result['exception'] = 'Proveedor incorrecto';
                                }
                                break;   
                                case 'valoracionesGrafica':
                                    if ($result['dataset'] = $edit->valoracionesGrafica()) {
                                         $result['status'] = 1;
                                    } else {
                                         if (Database::getException()) {
                                               $result['exception'] = Database::getException();
                                         } else {
                                               $result['exception'] = 'No hay datos registrados';
                                         }
                                    }						                    
                                break; 
             
               default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
