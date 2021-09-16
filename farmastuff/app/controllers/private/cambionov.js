const API_EMPLEADOS = '../../app/models/empleados.php?action=';


function changePasswordD(id, clave) {
    // Se restauran los elementos del formulario.
    document.getElementById('new-form').reset();
    const data = new FormData();
    console.log('id se envia' +id);
    data.append('idempleado', id);
    data.append('clavecam', clave);
    data.append('confclacam', clave);
    console.log('clave no se envia ' +clave);
    console.log('id se envia' +id);
    fetch(API_EMPLEADOS + 'changePasswordD', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('idempleado').value = response.dataset.idempleado;
                    document.getElementById('clavecam').value = response.dataset.clave;
                    M.updateTextFields();
                    
                } else {
                    sweetAlert(2, response.exception, 'login.php');
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


