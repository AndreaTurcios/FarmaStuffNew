// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_USUARIOS = '../app/api/usuarios.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se inicializa el componente Tooltip asignado al botón del formulario para que funcione la sugerencia textual.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));

    //PARA FECHA
    let today = new Date();
        // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
        let day = ('0' + today.getDate()).slice(-2);
        // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
        var month = ('0' + (today.getMonth() + 1)).slice(-2);
        // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
        let year = today.getFullYear() - 18;
        // Se declara e inicializa una variable para establecer el formato de la fecha.
        let date = `${year}-${month}-${day}`;
        // Se asigna la fecha como valor máximo en el campo del formulario.
        document.getElementById('fecha_nacimiento').setAttribute('max', date);

        // Petición para verificar si existen usuarios.
    fetch(API_USUARIOS + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje.
                if (response.status) {
                    sweetAlertM(3, response.message, 'index.php');
                } else {
                    // Se verifica si ocurrió un problema en la base de datos, de lo contrario se continua normalmente.
                    if (response.error) {
                        sweetAlertM(2, response.exception, null);
                    } else {
                        sweetAlertM(4, 'Debe crear un usuario para comenzar', null);
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

// Método manejador de eventos que se ejecuta cuando se envía el formulario de registrar.
document.getElementById('register-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_USUARIOS + 'register', {
        method: 'post',
        body: new FormData(document.getElementById('register-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlertM(1, response.message, 'index.php');
                } else {
                    sweetAlertM(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});