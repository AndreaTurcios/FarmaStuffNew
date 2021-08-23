<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/receta.php');

if (isset($_GET['action'])) {
    session_start();
    $receta = new recetas;
    $result = array('status' => 0, 'message' => null, 'exception' => null);
        switch ($_GET['action']) {
            case 'create':
                $_POST = $receta->validateForm($_POST);
                if (is_uploaded_file($_FILES['archivo_producto']['tmp_name'])) {
                    if ($receta->setFotoreceta($_FILES['archivo_producto'])) {
                        if ($receta->createRow()) {
                            $result['status'] = 1;
                            if ($receta->saveFile($_FILES['archivo_producto'], $receta->getRuta(), $receta->getFotoreceta())) {
                                $result['message'] = 'Producto creado correctamente';
                            } else {
                                $result['message'] = 'Producto creado pero no se guardó la imagen';
                            }
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = $receta->getImageError();
                    }
                } else {
                    $result['exception'] = 'Seleccione una imagen';
                }
                break;

                case 'creates':
                    $_POST = $receta->validateForm($_POST);
                    if (is_uploaded_file($_FILES['archivo_receta']['tmp_name'])) {
                        if ($receta->setFotoreceta($_FILES['archivo_receta'])) {
                            if (is_uploaded_file($_FILES['archivo_carnet']['tmp_name'])) {
                                if ($receta->setFotofrentecarnet($_FILES['archivo_carnet'])) {
                                    if (is_uploaded_file($_FILES['archivo_carnets']['tmp_name'])) {
                                        if ($receta->setFotoreversocarnet($_FILES['archivo_carnets'])) {
                            if ($receta->createRows()) {
                                $result['status'] = 1;
                                if ($receta->saveFile($_FILES['archivo_receta'], $receta->getRuta(), $receta->getFotoreceta())) {
                                    $result['message'] = 'Producto creado correctamente';
                                } else {
                                    $result['message'] = 'Producto creado pero no se guardó correctamente la imagen';
                                }
                                if ($receta->saveFile($_FILES['archivo_carnet'], $receta->getRuta(), $receta->getFotofrentecarnet())) {
                                    $result['message'] = 'Producto creado exitosamente';
                                } else {
                                    $result['message'] = 'Producto creado pero no se guardó la imagen correctamente';
                                }
                                if ($receta->saveFile($_FILES['archivo_carnets'], $receta->getRuta(), $receta->getFotoreversocarnet())) {
                                    $result['message'] = 'Producto creado correctamente';
                                } else {
                                    $result['message'] = 'Producto creado pero no se guardó la imagen correctamente';
                                }
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = $receta->getImageError();
                        } 
                    } else {
                        $result['exception'] = 'Seleccione una imagen';
                    }
                } else {
                    $result['exception'] = $receta->getImageError();
                } 
            } else {
                $result['exception'] = 'Seleccione una imagen';
            }
        } else {
            $result['exception'] = $receta->getImageError();
        } 
    } else {
        $result['exception'] = 'Seleccione una imagen';
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