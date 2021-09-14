
function changePassword(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('change-form').reset();
    let instance = M.Modal.getInstance(document.getElementById('change-modal'));
    instance.open();
    document.getElementById('modal-title').textContent = 'Actualizar contraseña';
    const data = new FormData();
    data.append('idempleado', id);
    fetch(API_EMPLEADOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                document.getElementById('idempleado').value = response.dataset.idempleado;
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
