const API_LOGIN = '../../app/api/private/login.php?action=';

document.addEventListener('DOMContentLoaded', function () {     
   
   document.getElementById('pass-form').hidden = true;

})


document.getElementById('codigo-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js      
    searchRowscodigo(API_LOGIN, 'codigo-form');
});

document.getElementById('pass-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js    
    action = 'restaurarClave';
    saveRow49(API_LOGIN, action ,'pass-form');
   
});