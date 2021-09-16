const API_LOGINNN = '../../app/api/private/login.php?action=';

// Función para mostrar el formulario de cambiar contraseña del usuario que ha iniciado sesión.
function openPasswordDialog() {
    // Se restauran los elementos del formulario.
    document.getElementById('change-form').reset();
    // Se abre la caja de dialogo (modal) que contiene el formulario para cambiar contraseña, ubicado en el archivo de las plantillas.
    let instance = M.Modal.getInstance(document.getElementById('change-modal'));
    instance.open();
}

function changePassword(id, clave) {
    // Se restauran los elementos del formulario.
    document.getElementById('change-form').reset();
    let instance = M.Modal.getInstance(document.getElementById('change-modal'));
    instance.open();
    document.getElementById('modal-title').textContent = 'Actualizar contraseña';
    const data = new FormData();
    data.append('idempleado', id);
    data.append('clave', clave);
    fetch(API_LOGINNN + 'changePassword', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('idempleado').value = response.dataset.idempleado;
                    document.getElementById('clave').value = response.dataset.clave;
                    M.updateTextFields();
                } else {
                    sweetAlert(2, response.exception, 'prueba');
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


document.getElementById('change-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('idempleado').value) {
        action = 'changePassword';
    } else {
    }
    saveRow(API_LOGINNN, action, 'change-form', 'change-modal');
});
