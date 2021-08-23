<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/public/ordenesCliente.php');

if (isset($_GET['action'])){
    session_start();
    $orden=new orden;
    $result = array ('status' => 0, 'message' =>null, 'exeception' => null); 
    if (isset($_SESSION['idcliente'])) {
        $result['session'] = 1;
        switch($_GET['action']){

            case 'createDetail':
                if ($orden->startOrder()) {
                    $_POST = $orden->validateForm($_POST); 
                    if ($orden->setProducto($_POST['id_producto'])) {
                        if ($orden->setCantidad($_POST['cantidad_producto'])) {
                            if ($orden->createDetail()) {
                                $result['status'] = 1;
                                $result['message'] = 'Producto agregado correctamente, ingreso éxitoso';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Cantidad incorrecta, ingrese otra cantidad';
                        }
                    } else {
                        $result['exception'] = 'Producto ingresado incorrectamente';
                    }
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
                case 'readOrderDetail':
                    if ($orden->startOrder()) {
                        if ($result['dataset'] = $orden->readOrderDetail()) {
                            $result['status'] = 1;
                            $_SESSION['idorden'] = $orden->getid();
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No tiene productos en el carrito';
                            }
                        }
                        
                    } else {
                        $result['exception'] = 'Debe agregar un producto al carrito';
                    }
                    break;
                    case 'updateDetail':
                        $_POST = $orden->validateForm($_POST);
                        if ($orden->setId_detalle($_POST['id_detalle'])) {
                            if ($orden->setCantidad($_POST['cantidad_producto'])) {
                                if ($orden->updateDetail()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Cantidad modificada correctamente';
                                } else {
                                    $result['exception'] = 'Ocurrió un problema al modificar la cantidad';
                                }
                            } else {
                                $result['exception'] = 'Cantidad incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Detalle incorrecto';
                        }
                        break;
                    case 'deleteDetail':
                        if ($orden->setId_detalle($_POST['id_detalle'])) {
                            if ($orden->deleteDetail()) {
                                $result['status'] = 1;
                                $result['message'] = 'Producto removido correctamente';
                            } else {
                                $result['exception'] = 'Ocurrió un problema al remover el producto';
                            }
                        } else {
                            $result['exception'] = 'Detalle incorrecto';
                        }
                        break;
                    case 'finishOrder':
                        if ($orden->finishOrder()) {
                            $result['status'] = 1;
                            $result['message'] = 'Pedido finalizado correctamente';
                        } else {
                            $result['exception'] = 'Ocurrió un problema al finalizar el pedido';
                        }
                        break;
                    default:
                        $result['exception'] = 'Acción no disponible dentro de la sesión';
                }
            } else {
                // Se compara la acción a realizar cuando un cliente no ha iniciado sesión.
                switch ($_GET['action']) {
                    case 'createDetail':
                        $result['exception'] = 'Debe iniciar sesión para agregar el producto al carrito';
                        break;
                    default:
                        $result['exception'] = 'Debe agregar productos al carrito para completar esta acción';
                }
            }
            // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
            header('content-type: application/json; charset=utf-8');
            // Se imprime el resultado en formato JSON y se retorna al controlador.
            print(json_encode($result));
        } else {
            print(json_encode('Recurso no disponible'));
        }
        
            