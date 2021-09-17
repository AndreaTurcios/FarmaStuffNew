// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_EMPLEADOS = "../../app/api/private/login.php?action=";

var inputClave = document.getElementById("clave");
var inputConfClave = document.getElementById("confclave");
var inputNombre = document.getElementById("nombreempleado");
var inputUsuario = document.getElementById("usuario");
var inputTelefono = document.getElementById("telefonoempleado");
var inputCorreo = document.getElementById("correoempleado");
var inputDireccion = document.getElementById("direccionempleado");
var inputApellido = document.getElementById("apellidoempleado");

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener("DOMContentLoaded", function () {
  // Se inicializa el componente Tooltip asignado al botón del formulario para que funcione la sugerencia textual.
  M.Tooltip.init(document.querySelectorAll(".tooltipped"));

  // Petición para verificar si existen usuarios.
  fetch(API_EMPLEADOS + "readAll", {
    method: "get",
  })
    .then(function (request) {
      // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
      if (request.ok) {
        request.json().then(function (response) {
          // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje.
          if (response.status) {
            sweetAlert(3, "Ya existe al menos un usuario", "login.php");
          } else {
            // Se verifica si ocurrió un problema en la base de datos, de lo contrario se continua normalmente.
            sweetAlert(4, "Debe crear un usuario para comenzar", null);
          }
        });
      } else {
        console.log(request.status + " " + request.statusText);
      }
    })
    .catch(function (error) {
      console.log(error);
    });
});

// Método manejador de eventos que se ejecuta cuando se envía el formulario de registrar.
document
  .getElementById("register-form")
  .addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_EMPLEADOS + "register", {
      method: "post",
      body: new FormData(document.getElementById("register-form")),
    })
      .then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
          request.json().then(function (response) {
            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
            if (response.status) {
              sweetAlert(1, response.message, "login.php");
            } else {
              if (response.users) {
                sweetAlert(2, response.exception, "login.php");
              } else {
                sweetAlert(2, response.exception, null);
              }
            }
          });
        } else {
          console.log(request.status + " " + request.statusText);
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  });
