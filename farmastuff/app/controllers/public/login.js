// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LOGIN = '../../app/api/public/login.php?action=';


document.getElementById('confirmacion-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js 
    searchRowsEmail(API_LOGIN, 'confirmacion-form');           
    var codigoos = document.getElementById("codigoos").value;
    confirmacion(codigoos);
});

function saveRowCodigo(api, action, form) {
    fetch(api + action, {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    console.log(request.status + ' ' + request.statusText);
                    //sweetAlert(1, response.message, null);
                } else {
                    console.log(request.status + ' ' + request.statusText);
                    //sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);     
    });
}

function searchRowsCodigo(api, form) {    
    
    fetch(api + 'readOneCodigo', {        
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;                                                         
                    document.getElementById('codigoos').value= codigo.value; 
                    action = 'codigoVerificacion';
                    saveRowCodigo(API_LOGIN, action ,'confirmacion-form');
                    sweetAlert(1, response.message, 'Código verificado');
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

function confirmacion(correo, codigo) {
    // Se restauran los elementos del formulario.
    document.getElementById('mail-form').reset();
    const data = new FormData();
    data.append('correo_empleados', correo);
fetch(API_CORREO, {     
    method: 'post',
    body: data
}).then(function (request) {
    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
    if (request.ok) {
        request.json().then(function (response) {
            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
            if (response.status) {                   
                sweetAlert(1, response.message, null);
            } else {
                // En caso contrario nos envia este mensaje
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

// Método manejador de eventos que se ejecuta cuando se envía el formulario de iniciar sesión.
document.getElementById('session-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    document.getElementById('databrowser').value = date.value
    document.getElementById('datafecha').value = browser.value
    document.getElementById('dataos').value = os.value    
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
                    sweetAlert(1, response.message, 'index.php');
                    action = 'historial';
                    saveRowhistorial(API_LOGIN, action ,'session-form');
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

function confirmacion(correo, codigoos) {
    // Se restauran los elementos del formulario.
    document.getElementById('confirmacion-form').reset();
    const data = new FormData();
    data.append('correo_empleados', correo);
fetch(API_CORREO, {     
    method: 'post',
    body: data
}).then(function (request) {
    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
    if (request.ok) {
        request.json().then(function (response) {
            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
            if (response.status) {                   
                sweetAlert(1, response.message, null);
            } else {
                // En caso contrario nos envia este mensaje
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