// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_EMPLEADOS = '../../app/api/private/empleados.php?action=';

var inputClave = document.getElementById('clave');
var inputConfClave = document.getElementById('confclave');
var inputNombre = document.getElementById('nombreempleado');
var inputUsuario = document.getElementById('usuario');
var inputTelefono = document.getElementById('telefonoempleado');
var inputCorreo = document.getElementById('correoempleado');
var inputDireccion = document.getElementById('direccionempleado');
var inputApellido = document.getElementById('apellidoempleado');

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se inicializa el componente Tooltip asignado al botón del formulario para que funcione la sugerencia textual.
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));

    // Petición para verificar si existen usuarios.
    fetch(API_EMPLEADOS + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje.
                if (response.status) {
                    sweetAlert(3, response.message, 'login.php');
                    inputDireccion.disabled = true;
                    inputCorreo.disabled = true;
                    inputTelefono.disabled = true;
                    inputApellido.disabled = true;
                    inputUsuario.disabled = true;
                    inputNombre.disabled = true;
                    inputClave.disabled = true;
                    inputConfClave.disabled = true;
                    
                } else {
                    // Se verifica si ocurrió un problema en la base de datos, de lo contrario se continua normalmente.
                    if (response.error) {
                        sweetAlert(2, response.exception, null);

                        //Se colocan esto para deshabilitar los campos, para que cuando se muestre la alerta y se quieran
                        //vulnerar no se pueda ya que está deshabilitado para editar.
                        inputDireccion.disabled = true;
                        inputCorreo.disabled = true;
                        inputTelefono.disabled = true;
                        inputApellido.disabled = true;
                        inputUsuario.disabled = true;
                        inputNombre.disabled = true;
                        inputClave.disabled = true;
                        inputConfClave.disabled = true;

                    } else {
                        sweetAlert(4, 'Debe crear un usuario para comenzar', null);
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

    fetch(API_EMPLEADOS + 'register', {
        method: 'post',
        body: new FormData(document.getElementById('register-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlert(1, response.message, 'login.php');

                } else {
                    sweetAlert(2, response.exception, 'Estamos probando');
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});