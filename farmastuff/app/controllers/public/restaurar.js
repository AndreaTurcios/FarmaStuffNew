// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LOGIN = '../../app/api/public/login.php?action=';
const EMPLEADOS = '../../helpers/emailtest.php';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    
})
   

document.getElementById('confirmacion-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js      
    searchRowsCodigoValidar(API_LOGIN, 'confirmacion-form');
});