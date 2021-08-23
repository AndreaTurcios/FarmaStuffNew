// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_PRODUCTOS = '../../app/api/private/producto.php?action=';
const ENDPOINT_ESTADO = '../../app/api/private/producto.php?action=readAllESTADO';
const ENDPOINT_TIPO = '../../app/api/private/producto.php?action=readAllTIPO';
const ENDPOINT_PROVEEDOR = '../../app/api/private/producto.php?action=readAllPROVEEDOR';
const ENDPOINT_PAIS = '../../app/api/private/producto.php?action=readAllPAIS';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js 
    readRows(API_PRODUCTOS);
});


// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {                
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.nombreproducto}</td>                
                <td>${row.descripcionproducto}</td>                
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.idproducto})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                    <a href="#" onclick="openDeleteDialog(${row.idproducto})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
                    <a href="#" onclick="openInsertProveedor(${row.idproducto})" class="btn waves-effect green tooltipped" data-tooltip="Agregar Proveedor"><i class="material-icons">mode_edit</i></a>
                    <a href="#" onclick="openShippers(${row.idproducto})" class="btn waves-effect grey tooltipped" data-tooltip="Buscar Ordenes"><i class="material-icons">search</i></a>      
                    <a href="../../app/reports/private/producto.php?id=${row.idproducto}" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte"><i class="material-icons">assignment</i></a>              
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


function fillTables(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
   dataset.map(function (row) {   
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `                           
            <tr>                                    
                <td>${row.nombrecompania}</td>
                <td>${row.representante}</td>
                <td>${row.pais}</td>
                <td>${row.existencias}</td>                
                <td>${row.precioporunidad}</td>                
                <td>${row.cantidadporunidad}</td>   
                <td>${row.codigoproducto}</td>
                <td><img src="../../resources/img/productos/${row.fotoproducto}" class="materialboxed" height="100"></td>                                 
                <td>
                <a href="#" onclick="openUpdateproveedor(${row.idproveedorproducto})" class="btn waves-effect blue tooltipped" data-tooltip="Actualizar"><i class="material-icons">mode_edit</i></a>
                </td>

            </tr>
        `;
      });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('Shipper-rows').innerHTML = content;
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}



document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_PRODUCTOS, 'search-form');
});

function openCreateDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Crear producto';
    // Se llama a la función para llenar el select del estado cliente         
  
} 


// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Actualizar producto';        
    // Se define un objeto con los datos del registro seleccionado.
    document.getElementById('archivo_producto').required = false;

    const data = new FormData();
    data.append('id_producto', id);

    fetch(API_PRODUCTOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_producto').value = response.dataset.idproducto;
                    document.getElementById('nombre_producto').value = response.dataset.nombreproducto;                    
                    document.getElementById('descripcion_producto').value = response.dataset.descripcionproducto;                                       
                    fillSelect(ENDPOINT_TIPO, 'tipo_producto', response.dataset.idtipoproducto);                    
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
    if (document.getElementById('id_producto').value) {
        action = 'update';
    } else {
        action = 'create';
    } 
   
    saveRow(API_PRODUCTOS, action, 'save-form', 'save-modal');
});


document.getElementById('save-proveedor-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = 'createRowP';
    //--- Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.    
            // if (document.getElementById('id_productoP').value) {
            //     action = 'update';
            // } else  {
            //     action = 'create';
            // }

    saveRow34(API_PRODUCTOS, action, 'save-proveedor-form', 'save-proveedor-modal');
});


document.getElementById('update-proveedor-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = 'updateRowShipper';
    //--- Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.    
            // if (document.getElementById('id_productosP').value) {
            //     action = 'update';
            // } else  {
            //     action = 'create';
            // }

    saveRowShip(API_PRODUCTOS, action, 'update-proveedor-form', 'update-proveedor-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_producto', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_PRODUCTOS, data);
}


// Función para preparar el formulario al momento de modificar un registro.
function openInsertProveedor(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-proveedor-form').reset();    
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-proveedor-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title-P').textContent = 'Agregar Proveedor';        
    // Se define un objeto con los datos del registro seleccionado.
    document.getElementById('nombre_productoa').disabled = true;  

    const data = new FormData();
    data.append('id_productoP', id);

    fetch(API_PRODUCTOS + 'readOneP', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_productoP').value = response.dataset.idproducto;
                    document.getElementById('nombre_productoa').value = response.dataset.nombreproducto;
                    fillSelect(ENDPOINT_PROVEEDOR, 'proveedor_productos', null);
                    fillSelect(ENDPOINT_PAIS, 'pais_productos', null);
                    fillSelect(ENDPOINT_ESTADO, 'estado_prodcuto', null);
                    fillSelect(ENDPOINT_TIPO, 'tipo_producto', null);                    
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


function openShippers(id) {
    // Se restauran los elementos del formulario.
    //document.getElementById('show-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('show-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Proveedores';
    // Se deshabilitan los campos de alias y contraseña.    
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_productoS', id);

    fetch(API_PRODUCTOS + 'readOneShipper', {
        method: 'post',     
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {               
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.                
                if (response.status) {                    
                    document.getElementById('id_productoS').value = response.dataset.idproducto;  
                    document.getElementById('nombre_productoS').value = response.dataset.nombreproducto;                                                                               
                    searchRows2(API_PRODUCTOS, 'show-form');                                                                      

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



function openUpdateproveedor(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('update-proveedor-form').reset();    
    // Se abre la caja de dialogo (modal) que contiene el formulario. 
    let instance = M.Modal.getInstance(document.getElementById('update-proveedor-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title-P').textContent = 'Agregar Proveedor';        
    // Se define un objeto con los datos del registro seleccionado.
    document.getElementById('nombre_productosa').disabled = true;
    document.getElementById('existencia_productosa').disabled = true;
    document.getElementById('estado_prodcutoa').disabled = true;
    document.getElementById('proveedor_productosa').disabled = true;  

    const data = new FormData();
    data.append('id_productosP', id);

    fetch(API_PRODUCTOS + 'readOneShipper1', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_productosP').value = response.dataset.idproveedorproducto;
                    document.getElementById('nombre_productosa').value = response.dataset.nombreproducto;
                    document.getElementById('cantidad_productosa').value = response.dataset.cantidadporunidad;
                    document.getElementById('precio_productosa').value = response.dataset.precioporunidad;
                    document.getElementById('existencia_productosa').value = response.dataset.existencias;
                    fillSelect(ENDPOINT_PROVEEDOR, 'proveedor_productosa', response.dataset.idproveedor);
                    fillSelect(ENDPOINT_PAIS, 'pais_productosa', response.dataset.idpais);
                    fillSelect(ENDPOINT_ESTADO, 'estado_prodcutoa', response.dataset.idestadoproducto);
                    fillSelect(ENDPOINT_TIPO, 'tipo_productosa', response.dataset.idtipoproducto);            
                     
                    //saveRow(API_PRODUCTOS, updateRowShipper, 'save-proveedor-form', 'save-proveedor-modal');
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
