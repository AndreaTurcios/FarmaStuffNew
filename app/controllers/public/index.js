// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_TIPO = '../../app/api/public/tipo.php?action=';
const API_CLIENTES = '../../app/api/private/cliente.php?action=';
//Método que agrega un controlador de eventos cuando el contenido del documento ha sido cargado
document.addEventListener('DOMContentLoaded', function() {
    //Se declaran las variables necesarias para inicializar los componentes del framework
    let elements, instances;
    //Se inicializa el componente sidenav
    elements = document.querySelectorAll('.sidenav');
    instances = M.Sidenav.init(elements);
    //Se inicializa el componente slider
    elements = document.querySelectorAll('.slider');
    instances = M.Slider.init(elements);
    //Se inicializa el componente modal
    elements = document.querySelectorAll('.modal');
    instances = M.Modal.init(elements);
    // Se llama a la función que muestra las categorías disponibles.
    readAllCategorias();

    // let params = new URLSearchParams(location.search);
    // // Se obtienen los datos localizados por medio de las variables.
    // const ID = params.get('id');
    // const NAME = params.get('nombre');
    // // Se llama a la función que muestra los productos de la categoría seleccionada previamente.
    // readProductosCategoria(ID, NAME);
}); 


document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const ID = params.get('id');
    const NAME = params.get('nombre');
    // Se llama a la función que muestra los productos de la categoría seleccionada previamente.
    readProductosCategorias();

    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows44(API_TIPO, 'search-form');
});


// Función para obtener y mostrar las categorías disponibles.
function readAllCategorias() {
    fetch(API_TIPO + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    let content = '';
                    let url = '';
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se define una dirección con los datos de cada categoría para mostrar sus productos en otra página web.
                        url = `productos.php?id=${row.idtipoproducto}&nombre=${row.tipoproducto}`;
                        // Se crean y concatenan las tarjetas con los datos de cada categoría.
                        content += `
                            <div class="col s12 m6 l4">
                                <div class="card hoverable">
                                    <div class="card-image waves-effect waves-block waves-light">
                                        <img class="activator" src="../../resources/img/categorias/${row.fototipo}">
                                    </div>
                                    <div class="card-content">
                                        <span class="card-title activator grey-text text-darken-4">
                                            ${row.tipoproducto}
                                            <i class="material-icons right">more_vert</i>
                                        </span>
                                        <p class="center">
                                            <a href="${url}" class="tooltipped" data-tooltip="Ver más">
                                                <i class="material-icons small">local_pharmacy</i>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="card-reveal">
                                        <span class="card-title grey-text text-darken-4">
                                            ${row.tipoproducto}
                                            <i class="material-icons right">close</i>
                                        </span>
                                        <p>${row.descripciontipo}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    // Se agregan las tarjetas a la etiqueta div mediante su id para mostrar las categorías.
                    document.getElementById('tipo').innerHTML = content;
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


// Función para obtener y mostrar los productos de acuerdo a la categoría seleccionada.
function readProductosCategorias(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('search', id);

    fetch(API_TIPO + 'searchProductosCategoria', {
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
                    //document.getElementById('title').innerHTML = `<i class="material-icons small">cloud_off</i><span class="red-text">${response.exception}</span>`;
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
} 



function fillTable(dataset){
    let content = '';
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                dataset.map(function (row) {
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

}