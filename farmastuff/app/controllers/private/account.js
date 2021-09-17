const API = '../../app/api/private/login.php?action=';

//Métodos manejadores de eventos que se ejecutan cuando se realiza una acción
document.addEventListener('click', sessionTime);

document.addEventListener('DOMContentLoaded', sessionTime);
// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    inactivityTime(); 
});

function sessionTime() 
{
        fetch(API + 'sessionTime', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
            if (request.ok) {
                request.json().then(function (response) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                    if (response.status) {
                        sweetAlert(4, response.message, 'login.php');
                    } else {
                        console.log('Sesión activa')
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
}

var inactivityTime = function () {
    var time;
    window.onload = resetTimer;
    // DOM Events
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;

    function logout() {
        sweetAlert(2, 'Se ha cerrado sesión por inactividad', 'login.php');
    }

    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(logout, 10000)
        // 1000 milliseconds = 1 second
    }
}

// Función para mostrar un mensaje de confirmación al momento de cerrar sesión.
function logOut() {
    swal({
        title: 'Advertencia',
        text: '¿Quiere cerrar la sesión?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de cerrar sesión, de lo contrario se muestra un mensaje.
        if (value) {
            fetch(API + 'logOut', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'login.php');
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
            sweetAlert(4, 'Puede continuar con la sesión', null);
        }
    });
}