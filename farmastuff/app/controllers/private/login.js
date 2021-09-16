// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LOGIN = '../../app/api/private/login.php?action=';
const API_CORREO = '../../app/api/private/validarcorreo.php';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se inicializa el componente Tooltip asignado al botón del formulario para que funcione la sugerencia textual.
    document.getElementById("codigovalidar").value = validarc.value;
    M.Tooltip.init(document.querySelectorAll('.tooltipped'));

    // Petición para verificar si existen usuarios.
    fetch(API_LOGIN + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                if (response.status) {
                    sweetAlert(4, 'Debe autenticarse para ingresar', null);
                } else {
                    // Se verifica si ocurrió un problema en la base de datos, de lo contrario se continua normalmente.
                    if (response.error) {
                    } else {
                       
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

function confirmacion(codigo) {
    // Se restauran los elementos del formulario.
    document.getElementById('session-form').reset();
    const data = new FormData();    
    data.append('codigovalidar', codigo );
fetch(API_CORREO, {     
    method: 'post',
    body: data
}).then(function (request) {
    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
    if (request.ok) {
        request.json().then(function (response) {
            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
            if (response.status) {
                document.getElementById("datavalidarc").value = validarc.value;
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



// Método manejador de eventos que se ejecuta cuando se envía el formulario de iniciar sesión.
document.getElementById('session-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();   

    document.getElementById('databrowser').value = date.value;
    document.getElementById('datafecha').value = browser.value;
    document.getElementById('dataos').value = os.value;        
    document.getElementById("codigovalidar").value = validarc.value; 
    var codigo = document.getElementById("codigovalidar").value = validarc.value; 
    
      fetch(API_LOGIN + 'logIn', {           
        method: 'post',
        body: new FormData(document.getElementById('session-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    confirmacion(codigo); 
                    document.getElementById("codigovalidar").value = validarc.value;
                    action = 'GuardarCodigoValidacion';
                    saveRowValidador(API_LOGIN, action ,'session-form');
                    action = 'historial';
                    saveRowhistorial(API_LOGIN, action ,'session-form');                     
                    sweetAlert(1, response.message, 'confirmacion.php');                    
                } else {
                    sweetAlert(2, response.exception, 'login.php');  
                }
                if (response.contra){
                    sweetAlert(3, response.exception, 'cambionov.php');
                } else{
                    sweetAlert(3, response.exception, null);

                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

function sessionTime() 
{
        fetch(API_LOGIN + 'sessionTime', {
            method: 'get'
        }).then(function (request) {
            // Se verifica si la petición que se está realizando es afirmativa y en dado caso ejecuta la acción
            if (request.ok) {
                request.json().then(function (response) {
                    if (response.status) {
                        sweetAlert(4, response.message, 'login.php');
                    } else {
                        console.log('Sesión activa')
                    }
                });
            } else {
                console.log(request.status + ' ' + request.statusText);
            }
        }).catch(function (error) {
            console.log(error);
        });
}

//Métodos manejadores de eventos que se ejecutan cuando se realiza una acción
document.addEventListener('click', sessionTime);

document.addEventListener('DOMContentLoaded', sessionTime);

function logOut() {
    swal({
        title: 'Advertencia',
        text: '¿Quiere cerrar la sesión?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de cerrar sesión, de lo contrario se muestra un mensaje.
        if (value) {
            fetch(API_LOGIN + 'logOut', {
                method: 'get'
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            sweetAlert(1, response.message, 'login.php');
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
        } else {
            sweetAlert(4, 'Puede continuar con la sesión', null);
        }
    });
}

fetch(API_LOGIN + 'tiempocontra', {
    method: 'post',
    body: new FormData(document.getElementById('session-form'))

}).then(function (request) {
    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
    if (request.ok) {
        request.json().then(function (response) {
            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
            if (response.status) {
                fetch(API_LOGIN + 'logIn', {
                    method: 'post',
                    body: new FormData(document.getElementById('session-form'))

                }).then(function (request) {
                    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                    if (request.ok) {
                        request.json().then(function (response) {
                            // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción
                            if (response.status) {
                                sweetAlert(1, response.message, null); 
                            

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

            } else {
                sweetAlert(4, response.exception, 'cambio.php');                  

            }
        });
    } else {
        console.log(request.status + ' ' + request.statusText);
    }
}).catch(function (error) {
    console.log(error);
});
