// Constantes para establecer las rutas y parámetros de comunicación con la API.
const API_PRODUCTOS = '../../app/api/private/producto.php?action=';
const ENDPOINT_ESTADO = '../../app/api/private/producto.php?action=readAllESTADO';
const ENDPOINT_TIPO = '../../app/api/private/producto.php?action=readAllTIPO';
const ENDPOINT_PROVEEDOR = '../../app/api/private/producto.php?action=readAllPROVEEDOR';
const ENDPOINT_PAIS = '../../app/api/private/producto.php?action=readAllPAIS';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows2(API_PRODUCTOS);
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
                <td>${row.existencias}</td>
                <td>${row.cantidadporunidad}</td>                
                <td><img src="../../resources/img/productos/${row.fotoproducto}" class="materialboxed" height="100"></td>
                <td>${row.estadoproducto}</td>                
                <td>${row.nombrecompania}</td> 
                <td>${row.codigoproducto}</td>                                      
                <td>
                    <a href="#" onclick="openUpdateDialog(${row.idproveedorproducto})" class="btn waves-effect green tooltipped" data-tooltip="Aprobar"><i class="material-icons">done</i></a>                    
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('rev-rows').innerHTML = content;
    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}


document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = 'revision';
    saveRow1(API_PRODUCTOS, action, 'save-form', 'save-modal');
});



function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario.
    let instance = M.Modal.getInstance(document.getElementById('save-modal'));
    instance.open();
    // Se asigna el título para la caja de dialogo (modal).
    document.getElementById('modal-title').textContent = 'Colocar en Stock Producto';        
    // Se define un objeto con los datos del registro seleccionado.   
    document.getElementById('nombre_producto').value = '1';
    const data = new FormData();
    data.append('id_productoR1', id);

    fetch(API_PRODUCTOS + 'readOneRev', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_productoR1').value = response.dataset.idproveedorproducto;                                       
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
