<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/productos.php'); 

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
	 // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
//session_start();
	 // Se instancia la clase correspondiente. 
	 $producto = new Productos;
	 // Se declara e inicializa un arreglo para guardar el resultado que retorna la API. 
	 $result = array('status' => 0, 'message' => null, 'exception' => null);
	 // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_SESSION['idempleado'])) {
		  // Se compara la acción a realizar cuando un administrador ha iniciado sesión. El socialismo no funciona 
		  switch ($_GET['action']) {
				case 'readAll':
					 if ($result['dataset'] = $producto->readAll()) {
						  $result['status'] = 1;
					 } else {
						  if (Database::getException()) {
								$result['exception'] = Database::getException();
						  } else {
								$result['exception'] = 'No hay productos registrados';
						  }
					 }
					 break;
					 case 'readAllESTADO':
						  if ($result['dataset'] = $producto->readAllESTADO()) {
								$result['status'] = 1;
						  } else {
								if (Database::getException()) {
									 $result['exception'] = Database::getException();
								} else {
									 $result['exception'] = 'No hay productos registrados';
								}
						  }
						  break;
						  case 'readAllTIPO':
								if ($result['dataset'] = $producto->readAllTIPO()) {
									 $result['status'] = 1;
								} else {
									 if (Database::getException()) {
										  $result['exception'] = Database::getException();
									 } else {
										  $result['exception'] = 'No hay productos registrados';
									 }
								}
						  break;
								case 'readAllPROVEEDOR':
									 if ($result['dataset'] = $producto->readAllPROVEEDOR()) {
										  $result['status'] = 1;
									 } else {
										  if (Database::getException()) {
												$result['exception'] = Database::getException();
										  } else {
												$result['exception'] = 'No hay productos registrados';
										  }
									 }
								break;
									 case 'readAllPAIS':
										  if ($result['dataset'] = $producto->readAllPAIS()) {
												$result['status'] = 1;
										  } else {
												if (Database::getException()) {
													 $result['exception'] = Database::getException();
												} else {
													 $result['exception'] = 'No hay productos registrados';
												}
										  }
									 break;
										  case 'readAllRevision':
												if ($result['dataset'] = $producto->readAllRevision()) {
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
					 $_POST = $producto->validateForm($_POST);
					 if ($_POST['search'] != '') {
						  if ($result['dataset'] = $producto->searchRows($_POST['search'])) {
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
					 case 'ExistenciaProductos':
						if ($result['dataset'] = $producto->ExistenciaProductos()) {
							 $result['status'] = 1;
						} else {
							 if (Database::getException()) {
								   $result['exception'] = Database::getException();
							 } else {
								   $result['exception'] = 'No hay datos registrados';
							 }
						}						                    
					break;
				case 'create':
					 $_POST = $producto->validateForm($_POST);
					 if ($producto->setNombre($_POST['nombre_producto'])) {
							if ($producto->setDescripcion($_POST['descripcion_producto'])) {							    															  													                                                       
								if ($producto->createRow()) {
									$result['status'] = 1;
									$result['message'] = 'Producto registrado correctamente';                                                        
								} else {
									$result['exception'] = Database::getException();                                                        
								} 																																																																																			
								  } else {
									$result['exception'] = 'Descripcion incorrecto';
								  }                            
								} else {
									 $result['exception'] = 'Nombre incorrecto';
								}
					 break;
				case 'readOne':
					 if ($producto->setId($_POST['id_producto'])) {
						  if ($result['dataset'] = $producto->readOne()) {
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
					 case 'readOneP':
						  if ($producto->setId($_POST['id_productoP'])) {
								if ($result['dataset'] = $producto->readOne()) {
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
						  case 'readAllShipper':
							if ($producto->setId($_POST['id_productoC'])) {
								  if ($result['dataset'] = $producto->readAllShipper()) {
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
							case 'readOneShipper1':
								if ($producto->setId($_POST['id_productosP'])) {
									  if ($result['dataset'] = $producto->readOneShipper1()) {
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

					 case 'readOneRev':
						  if ($producto->setId($_POST['id_productoR1'])) {
								if ($result['dataset'] = $producto->readOneRev()) {
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
								case 'update':
									 $_POST = $producto->validateForm($_POST);
									 if ($producto->setId($_POST['id_producto'])) {
										  if ($data = $producto->readOne()) {
												if ($producto->setNombre($_POST['nombre_producto'])) {                            
													 if ($producto->setDescripcion($_POST['descripcion_producto'])) {														  																	 																				                                                             																																			  
														  if ($producto->updateRow()) {
														      $result['status'] = 1;
															  $result['message'] = 'Cliente Actualizado correctamente';                                                        
															} else {
																$result['exception'] = Database::getException();                                                        
															}   
													 } else {
														  $result['exception'] = 'Descripcion incorrecto';
													 }
																	 
													 } else {
														  $result['exception'] = 'Nombre incorrecto';
													 }
												} else {
													 $result['exception'] = 'Producto inexistente';
												}
										  } else {
												$result['exception'] = 'Producto incorrecto';
										  }
									 break;

									 case 'updateRowShipper':
										$_POST = $producto->validateForm($_POST);
										if ($producto->setId($_POST['id_productosP'])) {
											 if ($data = $producto->readOneShipper1()) {
												if (isset($_POST['pais_productosa'])) {
													if ($producto->setPais($_POST['pais_productosa'])) {
														if (isset($_POST['tipo_productosa'])) {
															if ($producto->setTipo($_POST['tipo_productosa'])){ 												                              
														       if ($producto->setPrecio($_POST['precio_productosa'])) {
															     if ($producto->setCantidad($_POST['cantidad_productosa'])) {
																	if ($producto->updateRowShipper()) {
																		$result['status'] = 1;
																		$result['message'] = 'Datos Actualizados correctamente';                                                        
																	} else {
																		$result['exception'] = Database::getException();                                                        
																	} 

																		} else {
																			$result['exception'] = 'Seleccione una imagen';
																		}                                                        
																	} else {
																		$result['exception'] = 'Cantidad Tipo';
																	}
																} else {
																	$result['exception'] = 'Seleccione una imagen';
																  }                                                        
															  } else {
																   $result['exception'] = 'Cantidad incorrectos';
															  }		 
															} else {
																$result['exception'] = 'Descripcion incorrecto';
															}
																		
														} else {
															 $result['exception'] = 'Nombre incorrecto';
														}
												   } else {
														$result['exception'] = 'Producto inexistente';
												   }
											 } else {
												   $result['exception'] = 'Producto incorrecto';
											 }
										break;
					      case 'createRowP':
						  $_POST = $producto->validateForm($_POST);
						  if ($producto->setId($_POST['id_productoP'])) {
                           if (isset($_POST['proveedor_productos'])) {                              
                            if ($producto->setProveedor($_POST['proveedor_productos'])) {
                                if (isset($_POST['pais_productos'])) {
                                     if ($producto->setPais($_POST['pais_productos'])) {
										if (isset($_POST['estado_prodcuto'])) {
											if ($producto->setEstado($_POST['estado_prodcuto'])){
												if (isset($_POST['tipo_producto'])) {
													if ($producto->setTipo($_POST['tipo_producto'])){   
													if ($producto->setExistencia($_POST['existencia_productos'])) {                                          																                               
														if ($producto->setPrecio($_POST['precio_productos'])) {										  
															if ($producto->setCantidad($_POST['cantidad_productos'])) {	
																if (is_uploaded_file($_FILES['archivo_producto']['tmp_name'])) {                                            
																	if ($producto->setImagen($_FILES['archivo_producto'])) {																
																		if ($producto->createRowP()) {
																			$result['status'] = 1;
																	   if ($producto->saveFile($_FILES['archivo_producto'], $producto->getRuta(), $producto->getImagen())) {
																			$result['message'] = 'Producto creado correctamente';
																	   } else {
																			$result['message'] = 'Producto creado pero no se guardó la imagen';
																	   }
																	   } 
																		else {
																		 $result['exception'] = Database::getException();
																		}
															} else {
																$result['exception'] = $producto->getImageError();
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
															} else {
															$result['exception'] = 'Seleccione una imagen';
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
														} else {
														$result['exception'] = 'Seleccione una imagen';
														}                                               
													} else {
													  $result['exception'] = 'Seleccione una imagen';
													}                                                        
												} else {
													 $result['exception'] = 'Cantidad incorrecto';
												}
										  } else {
												$result['exception'] = 'Existencias incorrecto';
										  }
									 } else {
										  $result['exception'] = 'Precio incorrecto';
									 }
								} else {
									 $result['exception'] = 'Producto inexistente';
								}						 					                                           
					 break; 										 
				case 'delete':
					 if ($producto->setId($_POST['id_producto'])) {
						  if ($data = $producto->readOne()) {
								if ($producto->deleteRow()) {
									 $result['status'] = 1;									 
									$result['message'] = 'Producto eliminado correctamente';									  
								} else {
									 $result['exception'] = Database::getException();
								}
						  } else {
								$result['exception'] = 'Producto inexistente';
						  }
					 } else {
						  $result['exception'] = 'Producto incorrecto';
					 }
					 break;
					 case 'revision':
						  $_POST = $producto->validateForm($_POST);
								if ($producto->setId($_POST['id_productoR1'])) {
									 if ($data = $producto->readOneRev()) {
										  if ($producto->setEstado($_POST['nombre_producto'])){
												if ($producto->setExistencia($_POST['existencia_producto'])){
												if ($producto->updateRev()) {
													 $result['status'] = 1;
													 $result['message'] = 'Stock Configurado con exito';                                                        
												} else {
													 $result['exception'] = Database::getException();                                                        
												} 

										  } else {
												$result['exception'] = 'Ha Surgido un problema';
												}
										  } else {
												$result['exception'] = 'Ha Surgido un problema';
												}                            
								} else {
									 $result['exception'] = 'Producto inexistente';
								}
						  } else {
								$result['exception'] = 'Producto incorrecto';
						  }
					 break;
					 case 'searchOneShipper':
						$_POST = $producto->validateForm($_POST);
						if ($_POST['nombre_productoS'] != '') {
							if ($result['dataset'] = $producto->searchOneShipper($_POST['nombre_productoS'])) {
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
				case 'readOneShipper':      
					if ($producto->setId($_POST['id_productoS'])) {                            
						if ($result['dataset'] = $producto->readOneShipper()) {
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
					case 'readTipoProducto':
						if ($result['dataset'] = $producto->readTipoProducto()) {     
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
