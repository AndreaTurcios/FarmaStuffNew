const API_LOGIN = '../../app/api/private/login.php?action=';
const API_CORREO = '../../app/api/private/correos.php';
const EMPLEADOS = '../helpers/recuperacionmail.php';

document.addEventListener('DOMContentLoaded', function () {   
    
    document.getElementById("codigosenviar").value= codigo.value;
})



document.getElementById('mail-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js 
    searchRowsEmail(API_LOGIN, 'mail-form');           
    var correo = document.getElementById("correo_empleados").value;
    var codigo = document.getElementById("codigosenviar").value;
    confirmacion(correo, codigo);
});

function confirmacion(correo, codigo) {
        // Se restauran los elementos del formulario.
        document.getElementById('mail-form').reset();
        const data = new FormData();
        data.append('correo_empleados', correo);
        data.append('codigosenviar', codigo );
    fetch(API_CORREO, {     
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                if (response.status) {                   
                    sweetAlert(1, response.message, null);
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
    
}
