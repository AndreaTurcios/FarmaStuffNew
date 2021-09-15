<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/public/clientesPublic.php');

if (isset($_GET['action'])) {
    session_start();
    $Clientes = new Clientes;
    $result = array('status' => 0, 'message' => null, 'exception' => null);
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $Clientes->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay ningún cliente ingresado en la base de datos';
                    }
                }
                break;
            case 'create':
                $_POST = $Clientes->validateForm($_POST);
                $token = filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING);
                if ($token) {
                    $secretKey = '6LfpUGccAAAAAAt8U61xs-EfVti5QwVzCmLL6HTc';
                    $ip = $_SERVER['REMOTE_ADDR'];

                    $data = array(
                        'secret' => $secretKey,
                        'response' => $token,
                        'remoteip' => $ip
                    );

                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data)
                        ),
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false
                        )
                    );

                    $url = 'https://www.google.com/recaptcha/api/siteverify';
                    $context  = stream_context_create($options);
                    $response = file_get_contents($url, false, $context);
                    $captcha = json_decode($response, true);
                    if ($captcha['success']) {
                        if ($Clientes->setNombres($_POST['nombres_clientes'])) {
                            if ($Clientes->setApellidos($_POST['apellidos_clientes'])) {
                                if ($Clientes->setCorreo($_POST['correo_clientes'])) {
                                    if ($Clientes->setDUI($_POST['dui_clientes'])) {
                                        if ($Clientes->setDireccion($_POST['direccion_clientes'])) {
                                            if ($Clientes->setTelefono($_POST['telefono_clientes'])) {
                                                if ($Clientes->setUsuario($_POST['usuario'])) {  
                                                    if ($Clientes->setClave($_POST['clave'])) {  
                                                        if ($Clientes->createRow()) {
                                                                    $result['status'] = 1;
                                                                    $result['message'] = 'Empleado registrado exitosamente';                                                        
                                                        } else {
                                                                    $result['exception'] = Database::getException();                                                        
                                                        }  
                                                    } else {
                                                        $result['exception'] = $Clientes->getPasswordError();
                                                        $result['exception'] = 'La clave tiene que ser mayor a 7 digitos';
                                                    }
                                                }else {
                                                $result['exception'] ='Nombre de usuario incorrecto';
                                                }
                                            }else {
                                                $result['exception'] ='Nombre de usuario incorrecto';
                                            }
                                        }else {
                                            $result['exception'] ='Nombre de usuario incorrecto';
                                        }
                                    }else {
                                        $result['exception'] ='DUI incorrecto';
                                    }
                                }else {
                                    $result['exception'] ='Correo incorrecto';
                                }
                            }else {
                                $result['exception'] ='Apellido incorrecto';
                            }
                        }else {
                            $result['exception'] ='Apellido incorrecto';
                        }
                    }else {
                        $result['exception'] ='Apellido incorrecto';
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
        print(json_encode('Recurso no disponible'));
    }
    