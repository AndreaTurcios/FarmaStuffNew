<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/loginPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Cambio contraseña');
?>   
<br>
<div class="container">
    <div class="row">
        <!-- Formulario para iniciar sesión -->
        <form method="post" id="restore-form">
            <input id="datafecha" type="text" name="datafecha"  class="hide" />
            <input id="databrowser" type="text" name="databrowser" class="hide" />
            <input id="dataos" type="text" name="dataos" class="hide" />

            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">person_pin</i>
                <input id="usuario" type="text" name="usuario" class="validate" required/>
                <label for="usuario">Correo</label>
            </div>
            <div class="col s12 center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Enviar correo"><i class="material-icons">send</i></button>
            </div>
        </form>  
    </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('restaurar.js');
?>