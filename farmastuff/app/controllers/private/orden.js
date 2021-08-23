const API_ORDEN = '../../app/api/private/orden.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_ORDEN);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {       
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>   
                <td>${row.idorden}</td>             
                <td>${row.fechaenvio}</td>
                <td>${row.fecharecibo}</td>
                <td>${row.costoenvio}</td>
                <td>${row.nombrecliente}</td>
                <td>${row.apellidocliente}</td>
                <td>${row.usuariocliente}</td>
                <td>${row.nombreencargado}</td>
                <td>
                    <a href="#" onclick="openDeleteDialog(${row.idorden})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar"><i class="material-icons">delete</i></a>
                    <a href="../../app/reports/private/detallecliente.php?id=${row.idorden}" target="_blank" class="btn waves-effect amber tooltipped" data-tooltip="Reporte de Detalle de Orden"><i class="material-icons">assignment</i></a>
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
// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_ORDEN, 'search-form');
});

function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idOrden', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_ORDEN, data);
}


