// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LOGIN = '../../app/api/private/login.php?action=';
const EMPLEADOS = '../../helpers/emailtest.php';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    sweetAlert(4, 'Código de confirmación enviado correctamente, revise su correo para verificar su usuario', null);
})
    function confirmacion(codigo) {
        // Se restauran los elementos del formulario.
        document.getElementById('confirmacion-form').reset();
        const data = new FormData();
        data.append('codigoos', codigo);
        fetch(EMPLEADOS + '', {     
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                if (response.status) {
                    document.getElementById('codigoos').value = response.dataset.codigo;
                } else {
                    // En caso contrario nos envia este mensaje
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });

    document.getElementById('confirmacion-form').addEventListener('submit', function (event) {
        // Se evita recargar la página web después de enviar el formulario.
        event.preventDefault();
        updateRow(API_LOGIN, 'autenticacion');
    });
}