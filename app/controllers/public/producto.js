// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_TIPO = '../../app/api/public/tipo.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const ID = params.get('id');
    const NAME = params.get('nombre');
    // Se llama a la función que muestra los productos de la categoría seleccionada previamente.
    readProductosCategoria(ID, NAME);
    readProductos(ID);
});

// Función para obtener y mostrar los productos de acuerdo a la categoría seleccionada.
function readProductosCategoria(id, categoria) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_categoria', id);

    fetch(API_TIPO + 'readProductosCategoria', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let content = '';
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se crean y concatenan las tarjetas con los datos de cada producto.
                        content += `
                            <div class="col s12 m6 l4">
                                <div class="card hoverable">
                                    <div class="card-image">
                                        <img src="../../resources/img/productos/${row.fotoproducto}" class="materialboxed">
                                        <a href="detalle.php?id=${row.idproveedorproducto}" class="btn-floating halfway-fab waves-effect waves-light red tooltipped" data-tooltip="Ver detalle">
                                            <i class="material-icons">add</i>
                                        </a>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-title">${row.nombreproducto}</span>
                                        <p>Precio(US$) ${row.precioporunidad}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    // Se asigna como título la categoría de los productos.
                    document.getElementById('title').textContent = 'Categoría: ' + categoria;
                    // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar los productos.
                    document.getElementById('productos').innerHTML = content;
                    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
                    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
                    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                } else {
                    // Se presenta un mensaje de error cuando no existen datos para mostrar.
                    document.getElementById('title').innerHTML = `<i class="material-icons small">cloud_off</i><span class="red-text">${response.exception}</span>`;
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}



function readProductos(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_categoria', id);

    fetch(API_TIPO + 'readAllProductos', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let content = '';
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se crean y concatenan las tarjetas con los datos de cada producto.
                        content += `
                            <div class="col s12 m6 l4">
                                <div class="card hoverable">
                                    <div class="card-image">
                                        <img src="../../resources/img/productos/${row.fotoproducto}" class="materialboxed">
                                        <a href="detalle.php?id=${row.idproveedorproducto}" class="btn-floating halfway-fab waves-effect waves-light red tooltipped" data-tooltip="Ver detalle">
                                            <i class="material-icons">add</i>
                                        </a>
                                    </div>
                                    <div class="card-content">
                                        <span class="card-title">${row.nombreproducto}</span>
                                        <p>Precio(US$) ${row.precioporunidad}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    // Se asigna como título la categoría de los productos.                    
                    // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar los productos.
                    document.getElementById('productos').innerHTML = content;
                    // Se inicializa el componente Material Box asignado a las imagenes para que funcione el efecto Lightbox.
                    M.Materialbox.init(document.querySelectorAll('.materialboxed'));
                    // Se inicializa el componente Tooltip asignado a los enlaces para que funcionen las sugerencias textuales.
                    M.Tooltip.init(document.querySelectorAll('.tooltipped'));
                } else {
                    // Se presenta un mensaje de error cuando no existen datos para mostrar.                    
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}