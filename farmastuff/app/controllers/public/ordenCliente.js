const API_ORDEN = '../../app/api/public/ordenCliente.php?action=';
// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los productos del carrito de compras para llenar la tabla en la vista.
    readOrderDetail();
});

// Función para obtener el detalle del pedido (carrito de compras).
function readOrderDetail() {
    fetch(API_ORDEN + 'readOrderDetail', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                    let content = '';
                    // Se declara e inicializa una variable para calcular el importe por cada producto.
                    let subtotal = 0;
                    // Se declara e inicializa una variable para ir sumando cada subtotal y obtener el monto final a pagar.
                    let total = 0;
                    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        subtotal = row.precioproducto * row.cantidad;
                        total += subtotal;
                        content += `
                            <tr> 
                                <td>${row.nombreproducto}</td>
                                <td>${row.precioproducto}</td>
                                <td>${row.cantidad}</td>
                                <td>${subtotal.toFixed(2)}</td>
                                <td>
                                    <a href="#" onclick="openUpdateDialog(${row.iddetalleorden}, ${row.cantidad})" class="btn waves-effect blue tooltipped" data-tooltip="Cambiar"><i class="material-icons">exposure</i></a>
                                    <a href="#" onclick="openDeleteDialog(${row.iddetalleorden})" class="btn waves-effect red tooltipped" data-tooltip="Remover"><i class="material-icons">remove_shopping_cart</i></a>
                                </td>
                            </tr>
                        `;
                    });
                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('tbody-rows').innerHTML = content;
                    // Se muestra el total a pagar con dos decimales.
                    document.getElementById('pago').textContent = total.toFixed(2);
                    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                } else {
                    sweetAlert(4, response.exception, 'index.php');
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para abrir una caja de dialogo (modal) con el formulario de cambiar cantidad de producto.
function openUpdateDialog(id, quantity) {
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('item-modal'));
    instance.open();
    // Se inicializan los campos del formulario con los datos del registro seleccionado.
    document.getElementById('id_detalle').value = id;
    document.getElementById('cantidad_producto').value = quantity;
    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
    M.updateTextFields();
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de cambiar cantidad de producto.
document.getElementById('item-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_ORDEN + 'updateDetail', {
        method: 'post',
        body: new FormData(document.getElementById('item-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se actualiza la tabla en la vista para mostrar el cambio de la cantidad de producto.
                    readOrderDetail();
                    // Se cierra la caja de dialogo (modal) del formulario.
                    let instance = M.Modal.getInstance(document.getElementById('item-modal'));
                    instance.close();
                    sweetAlert(1, response.message, null);
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
});

// Función para mostrar un mensaje de confirmación al momento de finalizar el pedido.
function finishOrder() {
    swal({
        title: 'Aviso',
        text: '¿Está seguro de finalizar el pedido?',
        icon: 'info',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario se muestra un mensaje.
        if (value) {
            fetch(API_ORDEN + 'finishOrder', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'index.php');
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
            sweetAlert(4, 'Puede seguir comprando', null);
        }
    });
}

// Función para mostrar un mensaje de confirmación al momento de eliminar un producto del carrito.
function openDeleteDialog(id) {
    swal({
        title: 'Advertencia',
        text: '¿Está seguro de remover el producto?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para realizar la petición respectiva, de lo contrario no se hace nada.
        if (value) {
            // Se define un objeto con los datos del registro seleccionado.
            const data = new FormData();
            data.append('id_detalle', id);

            fetch(API_ORDEN + 'deleteDetail', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un producto del carrito.
                            readOrderDetail();
                            sweetAlert(1, response.message, null);
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
        }
    });
}