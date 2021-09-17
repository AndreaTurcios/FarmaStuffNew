<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/clientes.php');

    if (isset($_GET['action'])) {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
        session_start();
        // Se instancia la clase correspondiente. 
        $cliente = new Clientes;
        // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
        $result = array('status' => 0, 'message' => null, 'exception' => null);
        // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['idempleado'])) {
            // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
            switch ($_GET['action']) {
                case 'readAll':
                    if ($result['dataset'] = $cliente->readAll()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay Clientes registrados';
                        }
                    }                   
                    break; 
                    case 'readAllOrder':
                        if ($result['dataset'] = $cliente->readAllOrder()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay Clientes registrados';
                            }
                        }                   
                        break;                                      
                case 'search':
                    $_POST = $cliente->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $cliente->searchRows($_POST['search'])) {
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
                    
                case 'create':
                    $_POST = $cliente->validateForm($_POST);
                    if ($cliente->setNombres($_POST['nombres_clientes'])) {
                        if ($cliente->setApellidos($_POST['apellidos_clientes'])) {
                            if ($cliente->setTelefono($_POST['telefono_clientes'])) {
                                if ($cliente->setDUI($_POST['dui_clientes'])) {                                                                        
                                    if ($cliente->setDireccion($_POST['direccion_clientes'])) {
                                        if ($cliente->setCorreo($_POST['correo_clientes'])) {
                                                 if (isset($_POST['estado_clientes'])) {
                                                    if ($cliente->setEstado($_POST['estado_clientes'])) {                                                    
                                                        if ($cliente->createRow()) {
                                                              $result['status'] = 1;
                                                              $result['message'] = 'Cliente registrado correctamente';                                                        
                                                          } else {
                                                              $result['exception'] = Database::getException();                                                        
                                                          }   

                                                } else {
                                                    $result['exception'] = 'Error';
                                                }                                               
                                            } else {
                                                $result['exception'] = 'Seleccione un estado ';
                                            }
                                        } else {
                                            $result['exception'] = 'Correo incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Categoría incorrecta';
                                    }
                                } else {
                                    $result['exception'] = 'Seleccione una categoría';
                                }
                            } else {
                                $result['exception'] = 'Precio incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Descripción incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Nombre incorrecto';
                    }
                    break;
                case 'readOne':
                    if ($cliente->setId($_POST['id_cliente'])) {
                        if ($result['dataset'] = $cliente->readOne()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Cliente inexistente';
                            }
                        }
                    } else {
                        $result['exception'] = 'Cliente incorrecto';
                    }
                    break;
                    case 'readOneReport':
                        if ($cliente->setId($_POST['ids'])) {
                            if ($result['dataset'] = $cliente->readOneReport()) {
                                $result['status'] = 1;
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'Cliente inexistente';
                                }
                            }
                        } else {
                            $result['exception'] = 'Cliente incorrecto';
                        }
                    break;                   
                        case 'search1':
                            $_POST = $cliente->validateForm($_POST);
                            if ($_POST['nombres_clientesO'] != '') {
                                if ($result['dataset'] = $cliente->searchOneOrder($_POST['nombres_clientesO'])) {
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

                    case 'readOneOrder':      
                        if ($cliente->setId($_POST['id_clienteO'])) {                            
                            if ($result['dataset'] = $cliente->readOneOrder()) {
                                $result['status'] = 1;                                
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'Cliente inexistente Orden';
                                }
                            }                           
                        } else {
                            $result['exception'] = 'Cliente incorrecto Orden';
                        }                    
                        break;
                case 'update':
                $_POST = $cliente->validateForm($_POST);
                    if ($cliente->setId($_POST['id_cliente'])) {
                      if (isset($_POST['estado_clientes'])) {
                        if ($cliente->setEstado($_POST['estado_clientes'])) {                                                    
                            if ($cliente->updateRow()) {
                                  $result['status'] = 1;
                                  $result['message'] = 'Cliente Actualizado correctamente';                                                        
                              } else {
                                  $result['exception'] = Database::getException();                                                        
                              }   

                    } else {
                        $result['exception'] = 'Seleccione una imagen';
                    }                                               
                } else {
                    $result['exception'] = 'Seleccione una imagen';
                }
            } else {
                $result['exception'] = 'Seleccione una imagen';
            }
                    break;
                case 'delete':
                    if ($cliente->setId($_POST['id_cliente'])) {
                        if ($data = $cliente->readOne()) {
                            if ($cliente->deleteRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'Cliente Eliminado correctamente'; 
                               
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Cliente inexistente';
                        }
                    } else {
                        $result['exception'] = 'Cliente incorrecto';
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
    
