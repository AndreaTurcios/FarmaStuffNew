<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/tipo.php');
require_once('../../models/productos.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se instancian las clases correspondientes.
    session_start();
    $tipo = new Tipo; 
    $producto = new Productos;
    
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se compara la acción a realizar según la petición del controlador. 
    if (isset($_SESSION['idcliente'])) {
        $result['session'] = 1;
    switch ($_GET['action']) {
        case 'readAll':
            if ($result['dataset'] = $tipo->readAll()) {
                $result['status'] = 1;
            } else {
                if (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else { 
                    $result['exception'] = 'No existen categorías para mostrar';
                }
            }
            break;
            case 'readAllProductos':
                if ($result['dataset'] = $tipo->readProductosAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else { 
                        $result['exception'] = 'No existen categorías para mostrar';
                    }
                }
                break;
        case 'readProductosCategoria':
            if ($tipo->setId($_POST['id_categoria'])) {
                if ($result['dataset'] = $tipo->readProductosCategoria()) {
                    $result['status'] = 1;
                   
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen productos para mostrar';
                    }
                }
            } else {
                $result['exception'] = 'Categoría incorrecta';
            }
            break;
        case 'readOne':
            if ($producto->setId($_POST['id_producto'])) {
                if ($result['dataset'] = $producto->ReadDetail()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Producto inexistente';
                    }
                }
            } else {
                $result['exception'] = 'Producto incorrecto';
            }
            break;
            case 'createRow1':
                $_POST = $tipo->validateForm($_POST);
                if ($tipo->setEstrellas($_POST['valoracion'])) {
                    if ($tipo->setUsuario($_POST['usuario'])) { 
                         if ($tipo->setId($_POST['id_productos'])) {                   
                            if ($tipo->createRow1()) {
                                $result['status'] = 1;
                                $result['message'] = 'Producto registrado correctamente';                                                        
                            } else {
                                $result['exception'] = Database::getException();                                                        
                            } 
                    } else {
                        $result['exception'] = 'Valoracion no reconocida';
                   } 
                    } else {
                        $result['exception'] = 'Valoracion no reconocida';
                   }    
                } else {
                $result['exception'] = 'Producto inexistente';
           }
            break ;
            case 'createComentarios':
    if ($producto->setId($_POST['id_producta'])) {
    if ($producto->Comentarios()) {
        $_POST = $producto->validateForm($_POST);
        if ($producto->setComentario($_POST['Comentario'])) {  
                if ($producto->createComentarios()) {
                    $result['status'] = 1;
                    $result['message'] = 'Producto agregado correctamente';
                } else {
                    $result['exception'] = Database::getException();        
                }
           
        } else {
            $result['exception'] = 'Comentario incorrecto';
        }
    } else {
        $result['exception'] = 'no a comprado el producto';
    }
    } else {
        $result['exception'] = 'Producto inexistente';
    }

     break; 
            case 'searchProductosCategoria':
                $_POST = $tipo->validateForm($_POST);
                if ($_POST['search'] != '') {
                     if ($result['dataset'] = $tipo->searchProductosCategoria($_POST['search'])) {
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
        default:
            $result['exception'] = 'Acción no disponible';
    }  
}  
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
