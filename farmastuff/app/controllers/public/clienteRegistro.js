const API_REGISTER = '../../app/api/public/clienteUser.php?action=';


document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    reCAPTCHA();
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_cliente').value) {
        action = 'create';
    } else {
        action = 'create';
    }
    
    saveRow49(API_REGISTER, 'create', 'save-form');
});
// Función para obtener un token del reCAPTCHA y asignarlo al formulario.
function reCAPTCHA() {
// Método para generar el token del reCAPTCHA.
grecaptcha.ready(function () {
    // Se declara e inicializa una variable para guardar la llave pública del reCAPTCHA.
    let publicKey = '6LfpUGccAAAAAFHZ7KrEokJ9dUDy5bR_q_LFY7MU';
    // Se obtiene un token para la página web mediante la llave pública.
    grecaptcha.execute(publicKey, { action: 'submit' }).then(function (token) {
        // Se asigna el valor del token al campo oculto del formulario
        document.getElementById('g-recaptcha-response').value = token;
    });
});
}