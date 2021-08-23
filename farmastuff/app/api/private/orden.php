<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/Orden.php');

if (isset($_GET['action'])){
    session_start();
    $orden=new orden;
    $result = array ('status' => 0, 'message' =>null, 'exeception' => null); 
        switch($_GET['action']){

            case 'readAll':
                if ($result['dataset'] = $orden->readAll()) {
                    $result['status'] = 1;  
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay productos registrados';
                    }
                }
                break;  
                case 'search':
                    $_POST = $orden->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        if ($result['dataset'] = $orden->searchRows($_POST['search'])) {
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
                        if ($orden->setid($_POST['idOrden'])) {
                            if ($result['dataset'] = $orden->readOne()) {
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

                    case 'delete':
                        if ($orden->setId($_POST['idOrden'])) {
                            if ($data = $orden->readOne()) {
                                if ($orden->deleteRow()) {
                                    $result['status'] = 1;
                                    $result['message'] = 'orden eliminado correctamente'; 
                                   
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = 'Empleado inexistente';
                            }
                        } else {
                            $result['exception'] = 'orden incorrecto';
                        }
                        break;  

                        }
                        header('content-type: application/json; charset=utf-8');
                        print(json_encode($result));
                } else {
                    print(json_encode('Recurso no disponible'));
                }
            