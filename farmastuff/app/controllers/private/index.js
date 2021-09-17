// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LOGIN = '../../app/api/private/login.php?action=';
const API_PRODUCTOS = '../../app/api/private/producto.php?action=';
const API_ESTADOCLIENTE = '../../app/api/private/estadoClienteapi.php?action=';
const API_VALORACIONES = '../../app/api/private/edit_Usuaria.php?action=';
const API_EMPLEADOS = '../../app/api/private/empleados.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se inicializa el componente Tooltip asignado al botón del formulario para que funcione la sugerencia textual.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
    graficaBarrasCategorias();
    graficaPastelCategorias();
    graficaBarrasProductoss();
    graficaValoracioness();
    graficaEstado();
    
    // Petición para verificar si existen usuarios.
    fetch(API_LOGIN + 'readAll', {     
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                if (response.status) {
                    sweetAlert(4, 'Debe autenticarse para ingresar', null);
                } else {
                    // Se verifica si ocurrió un problema en la base de datos, de lo contrario se continua normalmente.
                    if (response.error) {
                        sweetAlert(2, response.exception, null);
                    } else {
                    }
                }
            });
        } 
        else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});



// Método manejador de eventos que se ejecuta cuando se envía el formulario de iniciar sesión.
document.getElementById('session-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_LOGIN + 'logIn', {
        method: 'post',
        body: new FormData(document.getElementById('session-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlert(1, response.message, 'confirmacion.php');
                } else {
                    sweetAlert(2, response.exception, 'no sirve');
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

function logOut() {
    swal({
        title: 'Advertencia',
        text: '¿Quiere cerrar la sesión?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de cerrar sesión, de lo contrario se muestra un mensaje.
        if (value) {
            fetch(API_LOGIN + 'logOut', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'login.php');
                        } else {
                            sweetAlert(2, response.exception, null);
                        }
                    });
                } else {
                    console.log(request.status + ' ' + request.statusText);
                }
            }).catch(function (error) {
                console.log(error);
            });
        } else {
            sweetAlert(4, 'Puede continuar con la sesión', null);
        }
    });
}

function graficaEstado() {
    fetch(API_EMPLEADOS + 'estadoEmpleadoR', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let estadoempleado = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        var l = '';
                        if(row.estadoempleado){l='Activos'} else{l='Inactivos'}
                        estadoempleado.push( l);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de pastel en porcentajes. Se encuentra en el archivo components.js
                   // pieGraph('chart5',['inactivos','activos'], cantidad, 'Porcentaje de empleados por estado' );
                    pieGraph('chart5',estadoempleado, cantidad, 'Porcentaje de empleados por estado' );
                } else {
                    document.getElementById('chart5').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function graficaBarrasProductoss() {
        fetch(API_PRODUCTOS + 'ExistenciaProductos', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                    if (response.status) {
                        // Se declaran los arreglos para guardar los datos por gráficar.
                        let nombreproducto = [];
                        let cantidad = [];
                        // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                        response.dataset.map(function (row) {
                            // Se asignan los datos a los arreglos.
                            nombreproducto.push(row.nombreproducto);
                            cantidad.push(row.cantidad);
                        });
                        // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                        barGraph('chart3', nombreproducto, cantidad, 'Cantidad de productos por existencia', 'Top de productos con mayor existencia');
                    } else {
                        document.getElementById('chart3').remove();
                        console.log(response.exception);
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
    }
    

    function graficaValoracioness() {
        fetch(API_VALORACIONES + 'valoracionesGrafica', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                    if (response.status) {
                        // Se declaran los arreglos para guardar los datos por gráficar.
                        let nombreproducto = [];
                        let cantidad = [];
                        // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                        response.dataset.map(function (row) {
                            // Se asignan los datos a los arreglos.
                            nombreproducto.push(row.nombreproducto);
                            cantidad.push(row.cantidad);
                        });
                        // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                        pieGraph('chart4', nombreproducto, cantidad, 'Top productos mejor valorados', 'cantidad');
                    } else {
                        document.getElementById('chart4').remove();
                        console.log(response.exception);
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
    }
// Función para mostrar el porcentaje de productos por categoría en una gráfica de pastel.
function graficaPastelCategorias() {
    fetch(API_ESTADOCLIENTE + 'CantidadEstadoCliente', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let Estado = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        Estado.push(row.estado);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de pastel en porcentajes. Se encuentra en el archivo components.js
                    pieGraph('chart2', Estado, cantidad, 'Porcentaje de Clientes por Estado');
                } else {
                    document.getElementById('chart2').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


// Función para mostrar la cantidad de productos por categoría en una gráfica de barras.
function graficaBarrasCategorias() {
    fetch(API_PRODUCTOS + 'readTipoProducto', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se remueve la etiqueta canvas de la gráfica.
                if (response.status) {
                    // Se declaran los arreglos para guardar los datos por gráficar.
                    let categorias = [];
                    let cantidad = [];
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se asignan los datos a los arreglos.
                        categorias.push(row.tipoproducto);
                        cantidad.push(row.cantidad);
                    });
                    // Se llama a la función que genera y muestra una gráfica de barras. Se encuentra en el archivo components.js
                    donutGraph('chart1', categorias, cantidad, 'Cantidad de productos por categoría', 'Cantidad de productos por categoría');
                } else {
                    document.getElementById('chart1').remove();
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}
