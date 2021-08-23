const API_RECETA = '../../app/api/private/recetas.php?action=';


document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action = '';
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.
    if (document.getElementById('id_receta').value) {
        action = 'create';
    } else {
        action = 'create';
    }
    saveRow4(API_RECETA, action, 'save-form');
});