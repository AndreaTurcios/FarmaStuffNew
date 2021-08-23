// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_TIPO = '../../app/api/public/tipo.php?action='; 
const API_PEDIDOS = '../../app/api/public/ordenCliente.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se busca en la URL las variables (parámetros) disponibles.
    let params = new URLSearchParams(location.search);
    // Se obtienen los datos localizados por medio de las variables.
    const ID = params.get('id');
    // Se llama a la función que muestra el detalle del producto seleccionado previamente.
    readOneProducto(ID);
});

// Función para obtener y mostrar los datos del producto seleccionado.
function readOneProducto(id) {
    // Se define un objeto con los datos del registro seleccionado. 
    const data = new FormData();
    data.append('id_producto', id);

    fetch(API_TIPO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se colocan los datos en la tarjeta de acuerdo al producto seleccionado previamente.
                    document.getElementById('imagen').setAttribute('src', '../../resources/img/productos/' + response.dataset.fotoproducto);
                    document.getElementById('nombre').textContent = response.dataset.nombreproducto;
                    document.getElementById('descripcion').textContent = response.dataset.descripcionproducto;
                    document.getElementById('precio').textContent = response.dataset.precioporunidad;
                    // Se asigna el valor del id del producto al campo oculto del formulario.
                    document.getElementById('id_producto').value = response.dataset.idproveedorproducto;
                    document.getElementById('id_producta').value = response.dataset.idproveedorproducto;

                } else {
                    // Se presenta un mensaje de error cuando no existen datos para mostrar.
                    document.getElementById('title').innerHTML = `<i class="material-icons small">cloud_off</i><span class="red-text">${response.exception}</span>`;
                    // Se limpia el contenido cuando no hay datos para mostrar.
                    document.getElementById('detalle').innerHTML = '';
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


document.getElementById('valoracion-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();    

    var valor = null;
    var s1 = document.getElementById('e1').value='1';
    var s2= document.getElementById('e2').value='1';
    var s3 =document.getElementById('e3').value='1';
    var s4 =document.getElementById('e4').value='1';
    var s5 = document.getElementById('e5').value='1';

    if(e1.checked==true && e2.checked==false && e3.checked==false && e4.checked==false && e5.checked==false ){   
        valor = 1;     
        document.getElementById('valoracion').value=valor;   
    }
    if (e1.checked==true && e2.checked==true && e3.checked==false && e4.checked==false && e5.checked==false ){
        valor = 2;        
        document.getElementById('valoracion').value=valor;
    }
    if(e1.checked==true && e2.checked==true && e3.checked==true &&  e4.checked==false && e5.checked==false){
        valor = 3;  
        document.getElementById('valoracion').value=valor;      
    }
    if(e1.checked==true && e2.checked==true && e3.checked==true && e4.checked==true && e5.checked==false ){
        valor = 4;   
        document.getElementById('valoracion').value=valor;     
    }
    if(e1.checked==true && e2.checked==true && e3.checked==true && e4.checked==true && e5.checked==true){
        valor = 5; 
        document.getElementById('valoracion').value=valor;       
    }
    if(e1.checked==false && e2.checked==false && e3.checked==false && e4.checked==false && e5.checked==false){
        sweetAlert(2, exception, null);           
    }
    if(e1.checked==true && e2.checked==false && e3.checked==true && e4.checked==false && e5.checked==true){
        sweetAlert(2, exception, null);           
    }
    document.getElementById('id_productos').value=id_producto.value;
    document.getElementById('usuario').value= users.value ;

    action = 'createRow1';
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js    
    saveRow25(API_TIPO, action ,'valoracion-form');
}); 
// Método manejador de eventos que se ejecuta cuando se envía el formulario de agregar un producto al carrito.
document.getElementById('shopping-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.

    event.preventDefault();

    fetch(API_PEDIDOS + 'createDetail', {
        method: 'post',
        body: new FormData(document.getElementById('shopping-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se constata si el cliente ha iniciado sesión.
                if (response.status) {
                    sweetAlert(1, response.message, 'carritoCompras.php');
                } else {
                    // Se verifica si el cliente ha iniciado sesión para mostrar la excepción, de lo contrario se direcciona para que se autentique. 
                    if (response.session) {
                        sweetAlert(2, response.exception, null);
                    } else {
                        sweetAlert(3, response.exception, 'login.php');
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
    
});
// Método manejador de eventos que se ejecuta cuando se envía el formulario de agregar un producto al carrito.
document.getElementById('Coment-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.

    event.preventDefault();

    fetch(API_TIPO + 'createComentarios', {
        method: 'post',
        body: new FormData(document.getElementById('Coment-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se constata si el cliente ha iniciado sesión.
                if (response.status) {
                    sweetAlert(1, response.message, null);
                } else {
                    // Se verifica si el cliente ha iniciado sesión para mostrar la excepción, de lo contrario se direcciona para que se autentique. 
                    if (response.session) {
                        sweetAlert(2, response.exception, null);
                    } else {
                        sweetAlert(3, response.exception, null);
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});


document.getElementById('Coment-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_TIPO + 'createComentarios', {
        method: 'post',
        body: new FormData(document.getElementById('Coment-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se constata si el cliente ha iniciado sesión.
                if (response.status) {
                    sweetAlert(1, response.message, null);
                } else {
                    // Se verifica si el cliente ha iniciado sesión para mostrar la excepción, de lo contrario se direcciona para que se autentique. 
                    if (response.session) {
                        sweetAlert(2, response.exception, null);
                    } else {
                        sweetAlert(3, response.exception, null);
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

