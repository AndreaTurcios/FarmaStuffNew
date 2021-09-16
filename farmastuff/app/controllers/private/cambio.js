


// Función para mostrar el formulario de cambiar contraseña del usuario que ha iniciado sesión.
function openPasswordDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('password-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario para cambiar contraseña, ubicado en el archivo de las plantillas.
    let instance = M.Modal.getInstance(document.getElementById('password-modal'));
    instance.open();
}

const API_LOGINN = '../../app/api/private/login.php?action=';



function changePassword(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('change-form').reset();
    let instance = M.Modal.getInstance(document.getElementById('change-modal'));
    instance.open();
    document.getElementById('modal-title').textContent = 'Actualizar contraseña';
}

document.getElementById('change-form').addEventListener('submit', function (event) {
    event.preventDefault();
    
    fetch(API_LOGINN + 'changePassword', {
        method: 'post',
        body: new FormData(document.getElementById('change-form'))
    }).then(function (request) {
        if (request.ok) {
            request.json().then(function (response) {
                if (response.status) {
                    let instance = M.Modal.getInstance(document.getElementById('change-modal'));
                    instance.close();
                    sweetAlert(1, response.message, null);
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


//document.getElementById('change-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
  //  event.preventDefault();
   // saveRow(API_LOGINN, 'changePassword', 'change-form', 'change-modal');
//});

