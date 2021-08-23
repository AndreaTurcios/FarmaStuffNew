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
                                        }
                                }else {
                                    $result['exception'] ='direccion incorrecto';
                                }
                            }else {
                                $result['exception'] ='dui incorrecta';
                            }
                        }else {
                            $result['exception'] ='Correo incorrecto';
                        }
                    }else {
                        $result['exception'] ='Apellido incorrecto';
                    }
                }else {
                    $result['exception'] ='Nombre incorrecto';
                }
                    
                break;
                   
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));

    } else {
        print(json_encode('Recurso no disponible'));
    }
    