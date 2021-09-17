const API_REGISTER = '../../app/api/public/clienteUser.php?action=';

document.addEventListener('DOMContentLoaded', function () {
    reCAPTCHA();
});
//document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    //event.preventDefault();
    //let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    //if (document.getElementById('id_cliente').value) {
    //    action = 'create';
    //} else {
    //    action = 'create';
    //}
    
  //  saveRow49(API_REGISTER, 'create', 'save-form');
//});

function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6LfpUGccAAAAAFHZ7KrEokJ9dUDy5bR_q_LFY7MU', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
          });
        });
      }

// Función para obtener un token del reCAPTCHA y asignarlo al formulario.
function reCAPTCHA() {
// Método para generar el token del reCAPTCHA.
grecaptcha.ready(function () {
    // Se declara e inicializa una variable para guardar la llave pública del reCAPTCHA.
    let publicKey = '6LfpUGccAAAAAFHZ7KrEokJ9dUDy5bR_q_LFY7MU';
    // Se obtiene un token para la página web mediante la llave pública.
    grecaptcha.execute(publicKey, { action: 'homepage' }).then(function (token) {
        // Se asigna el valor del token al campo oculto del formulario
        document.getElementById('g-recaptcha-response').value = token;
    });
});
}
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    fetch(API_REGISTER + 'create', {
        method: 'post',
        body: new FormData(document.getElementById('save-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    sweetAlert(1, response.message, 'login.php');
                } else {
                    // Se verifica si el token falló (ya sea por tiempo o por uso).
                    if (response.recaptcha) {
                        sweetAlert(2, response.exception, 'login.php');
                    } else {
                        sweetAlert(2, response.exception, null);
                        // Se genera un nuevo token.
                        reCAPTCHA();
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