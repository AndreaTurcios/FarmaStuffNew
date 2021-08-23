const API_REGISTER = '../../app/api/public/clienteUser.php?action=';


document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_cliente').value) {
        action = 'create';
    } else {
        action = 'create';
    }
    
    saveRow4(API_REGISTER, 'create', 'save-form');
});
