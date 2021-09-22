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
                unset($_SESSION['idempleado']);
                unset($_SESSION['usuario']);
                unset($_SESSION['correo']);
                $result['status'] = 1;
                $result['message'] = 'Sesión eliminada correctamente';
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
            case 'GuardarCodigoValidacion':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setCodigoo($_POST['codigovalidar'])) {
                    if ($usuario->setId($_SESSION['idempleado'])) {
                        if ($usuario->GuardarCodigoValidacion()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Ingrese un valor para validar identidad';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para enviar codigo';
                }
                break;
            case 'logIn':
                $_SESSION['cont'] =  $_SESSION['cont'] + 1;
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
                            $_SESSION['cont'] = $_SESSION['cont'] + 1;
                        } else {
                            $result['exception'] = 'Error';
                            $_SESSION['cont'] = $_SESSION['cont'] + 1;
                        }
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                        $result['exception'] = 'Error';
                        $_SESSION['cont'] = $_SESSION['cont'] + 1;
                    } else {
                        $result['exception'] = 'Alias incorrecto';
                        $_SESSION['cont'] = $_SESSION['cont'] + 1;
                    }
                }
                if ($_SESSION['cont'] >= 3) {
                    $result['exception'] = 'Se ha superado el número de intentos permitidos. Se ha bloqueado su usuario.
                Hable con un administrador para poder recuperar su usuario';
                }
                break;
            case 'readOneCodigo':
                $_POST = $usuario->validateForm($_POST);
                if ($_POST['codigoos'] != '') {
                    if ($result['dataset'] = $usuario->searchRows($_POST['codigoos'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        $result['message'] = 'Código encontrado en el registro';
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
            case 'readCodigoSesiones':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setCodigoo($_POST['codigoos'])) {
                    if ($usuario->readCodigoSesiones()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para enviar dato';
                }
                break;
            case 'changePassword':
                if ($usuario->setId($_SESSION['idempleado'])) {
                    $_POST = $usuario->validateForm($_POST);
                    if ($_POST['clavempleado'] == $_POST['confclave']) {
                        if ($usuario->setClave($_POST['clavempleado'])) {
                            if ($usuario->updateRowPassword()) {
                                $result['status'] = 1;
                                $result['message'] = 'Usuario modificado correctamente';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = $usuario->getPasswordError();
                        }
                    } else {
                        $result['exception'] = 'Claves diferentes';
                    }
                } else {
                    $result['exception'] = 'Claves diferentes';
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
    } else {
        // Se compara la acción a realizar cuando el cliente no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'register':
                if (!$usuario->readAll()) {
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->setNombreEmpleado($_POST['nombreempleado'])) {
                        if ($usuario->setApellidoEmpleado($_POST['apellidoempleado'])) {
                            if ($usuario->setTelefonoEmpleado($_POST['telefonoempleado'])) {
                                if ($usuario->setDireccionEmpleado($_POST['direccionempleado'])) {
                                    if ($usuario->setCorreoEmpleado($_POST['correoempleado'])) {
                                        $usuario->setEstadoEmpleado(1);
                                        if ($usuario->setUsuario($_POST['usuario'])) {
                                            if ($_POST['clave'] == $_POST['confclave']) {
                                                if ($usuario->setClave($_POST['clave'])) {
                                                    $usuario->setIDTipoEmpleado(1);
                                                    if ($usuario->createRow()) {
                                                        $result['status'] = 1;
                                                        $result['message'] = 'Empleado registrado correctamente';
                                                    } else {
                                                        $result['exception'] = Database::getException();
                                                    }
                                                } else {
                                                    $result['exception'] = $usuario->getPasswordError();
                                                }
                                            } else {
                                                $result['exception'] = 'Claves diferentes';
                                            }
                                        } else {
                                            $result['exception'] = 'Usuario incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Correo incorrecto';
                                    }
                                } else {
                                    $result['exception'] = 'Dirección incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Teléfono incorrecto';
                            }
                        } else {
                            $result['exception'] = 'Apellidos incorrectos';
                        }
                    } else {
                        $result['exception'] = 'Nombres incorrectos';
                    }
                } else {
                    $result['exception'] = 'Ya existen usuarios registrados';
                    $result['users'] = 1;
                }
                break;

            case 'readAll':
                if ($usuario->readAll()) {
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
            case 'GuardarCodigoValidacion':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setCodigoo($_POST['datavalidarc'])) {
                    if ($usuario->setId($_SESSION['idempleado'])) {
                        if ($usuario->GuardarCodigoValidacion()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Ingrese un valor para validar identidad';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para enviar codigo';
                }
                break;
            case 'readOneMails':
                $_POST = $usuario->validateForm($_POST);
                if ($_POST['correo_empleados'] != '') {
                    if ($result['dataset'] = $usuario->searchRows($_POST['correo_empleados'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        $result['message'] = 'Correo Encontrado en el registro';
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
            case 'codigoVerificacion':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setCodigo($_POST['codigosenviar'])) {
                    if ($usuario->setCorreo($_POST['correo'])) {
                        if ($usuario->saveCodigo()) {
                            $result['status'] = 1;
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Ingrese un valor para enviar correo';
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para enviar codigo';
                }
                break;
            case 'validarUsuario':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setCodigo($_POST['codigosenviar'])) {
                    if ($usuario->verificarUsuario()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para enviar dato';
                }
                break;
            case 'validarClave':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setCodigo($_POST['codigosenviar'])) {
                    if ($usuario->verificarClaves()) {
                        $result['status'] = 1;
                    } else {
                        $result['exception'] = Database::getException();
                    }
                } else {
                    $result['exception'] = 'Ingrese un valor para enviar dato';
                }
                break;
            case 'verificarCodigo':
                if ($usuario->setCodigo($_POST['codigos'])) {
                    if ($result['dataset'] = $usuario->verificarCodigo()) {
                        $result['status'] = 1;
                        $result['message'] = 'Codigo Correcto';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Codigo incorrecto';
                        }
                    }
                } else {
                    $result['exception'] = 'Codigo Inexistente';
                }
                break;
            case 'restaurarClave':
                $_POST = $usuario->validateForm($_POST);
                if ($_POST['clave'] == $_POST['confirmacion']) {
                    if ($usuario->setClave($_POST['clave'])) {
                        if ($usuario->updateCodigo()) {
                            $result['status'] = 1;
                            $result['message'] = 'Clare restaurada correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = $usuario->getPasswordError();
                    }
                } else {
                    $result['exception'] = 'Claves distintas';
                }
                break;

            case 'changePassword':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_POST['idempleado'])) {
                    if ($usuario->readOne()) {
                        if ($_POST['clavempleado'] == $_POST['confclave']) {
                            if ($usuario->setClave($_POST['clavempleado'])) {
                                if ($usuario->updatePassword()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Usuario modificado correctamente';
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Clave incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Claves diferentes';
                        }
                    } else {
                        $result['exception'] = $usuario->getPasswordError();
                    }
                } else {
                    $result['exception'] = 'Claves diferentes';
                }
                break;
            case 'tiempocontra':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->checkUser($_POST['usuario'])) {
                    if ($usuario->getEstadoEmpleado() == false) {
                        if ($usuario->checkPassword($_POST['clave'])) {
                            if ($usuario->obtenerDiff()) {
                                $result['exception'] = 'Debe cambiar su contraseña';
                            } else {
                                $result['status'] = 1;
                                $result['message'] = 'Su contraseña es válida';
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Clave incorrecta';
                            }
                        }
                    } else {
                        $result['exception'] = 'Ya han pasado 90 días desde su cambio de contraseña, restaurela para poder ingresar ';
                    }
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Correo incorrecto';
                    }
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible fuera de la sesión';
        }
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
