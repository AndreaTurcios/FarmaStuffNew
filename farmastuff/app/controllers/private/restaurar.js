// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LOGIN = '../../app/api/private/login.php?action=';
const RESTAURAR = '../../app/api/private/login.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    readRows(API_EMPLEADOSS1);
    sweetAlert(6, 'Ingrese el correo asociado a su usuario', null);
    })

    fetch(RESTAURAR + 'autenticacion', {     
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                if (response.status) {
                    sweetAlert(1, 'Usuario confirmado correctamente', null);
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
