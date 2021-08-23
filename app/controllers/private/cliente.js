// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTES = '../../app/api/private/cliente.php?action=';
const ENDPOINT_ESTADO = '../../app/api/private/estadoClienteapi.php?action=readAll';

document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_CLIENTES);           
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {       
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>                
                <td>${row.nombrecliente}</td>
                <td>${row.apellidocliente}</td>
                <td>${row.telefonocliente}</td>
                <td>${row.duicliente}</td>
                <td>${row.direccioncliente}</td>
                <td>${row.correocliente}</td>     
                <td>${row.estado}</td>   
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.idcliente})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                    <a href="#" onclick="openDeleteDialog(${row.idcliente})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>                    
                    <a href="#" onclick="openOrders(${row.idcliente})" class="btn waves-effect green tooltipped" data-tooltip="Buscar Ordenes"><i class="material-icons">search</i></a>                    
                    <a href="../../app/reports/private/ordenescliente.php?id=${row.idcliente}" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de Ordenes"><i class="material-icons">assignment</i></a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}


// // Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTables(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
   dataset.map(function (row) {   
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `                           
            <tr>                                    
                <td>${row.fechaenvio}</td>
                <td>${row.fecharecibo}</td>
                <td>${row.nombreproducto}</td>
                <td><img src="../../resources/img/productos/${row.fotoproducto}" class="materialboxed" height="100"></td>
                <td>${row.preciototal}</td>                
                <td>${row.costoenvio}</td>   
                <td>${row.cantidad}</td>                                                   
            </tr>
        `;
      });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('Order-rows').innerHTML = content;
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}


document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_CLIENTES, 'search-form');
});

function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Crear cliente';
    // Se llama a la función para llenar el select del estado cliente 
    document.getElementById('nombres_clientes').disabled = false;
    document.getElementById('apellidos_clientes').disabled = false;
    document.getElementById('telefono_clientes').disabled = false;
    document.getElementById('dui_clientes').disabled = false;
    document.getElementById('direccion_clientes').disabled = false;
    document.getElementById('correo_clientes').disabled = false;
    fillSelect(ENDPOINT_ESTADO, 'estado_clientes', null);
  
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar cliente';
    // Se deshabilitan los campos de alias y contraseña.
    document.getElementById('nombres_clientes').disabled = true;
    document.getElementById('apellidos_clientes').disabled = true;
    document.getElementById('telefono_clientes').disabled = true;
    document.getElementById('dui_clientes').disabled = true;
    document.getElementById('direccion_clientes').disabled = true;
    document.getElementById('correo_clientes').disabled = true;
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_cliente', id);

    fetch(API_CLIENTES + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_cliente').value = response.dataset.idcliente;
                    document.getElementById('nombres_clientes').value = response.dataset.nombrecliente;
                    document.getElementById('apellidos_clientes').value = response.dataset.apellidocliente;
                    document.getElementById('telefono_clientes').value = response.dataset.telefonocliente;
                    document.getElementById('dui_clientes').value = response.dataset.duicliente;
                    document.getElementById('direccion_clientes').value = response.dataset.direccioncliente;
                    document.getElementById('correo_clientes').value = response.dataset.correocliente;
                    fillSelect(ENDPOINT_ESTADO, 'estado_clientes', response.dataset.idestadocliente);
                    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
                    M.updateTextFields();                    
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


document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_cliente').value) {
        action = 'update';
    } else {
        action = 'create';
    }
    saveRow(API_CLIENTES, action, 'save-form', 'save-modal');
}); 


function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_cliente', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_CLIENTES, data);
}


function openOrders(id) {
    // Se restauran los elementos del formulario.
    //document.getElementById('show-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('show-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Orden cliente';
    // Se deshabilitan los campos de alias y contraseña.    
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_clienteO', id);

    fetch(API_CLIENTES + 'readOneOrder', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {               
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.                
                if (response.status) {                    
                    document.getElementById('id_clienteO').value = response.dataset.idcliente;  
                    document.getElementById('nombres_clientesO').value = response.dataset.duicliente;                                                                               
                    searchRows1(API_CLIENTES, 'show-form');                                                                      

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