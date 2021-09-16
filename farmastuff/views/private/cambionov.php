<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Cambio contraseña');
?>
<br>
<div class="container">
    <div class="row">
        <!-- Formulario para cambiar contraseña -->
        <form method="post" id="new-form">
            <input id="datafechaa" type="text" name="datafecha" class="hide" />
            <input id="databrowserr" type="text" name="databrowser" class="hide" />
            <input id="dataoss" type="text" name="dataos" class="hide" />

            <!-- <input class="hide" type="number" id="idempleado" name="idempleado" class="validate" required/>-->


            <div class="input-field col s12 m6">
                <i class="material-icons prefix">security</i>
                <input type="password" id="clavecam" name="clavecam" class="validate" required />
                <label for="clavecam">Clave</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">security</i>
                <input type="password" id="confclacam" name="confclacam" class="validate" required />
                <label for="confclacam">Confirmar clave</label>
            </div>
    </div>
    <div class="col s12 center-align">
        <button type="submit" class="btn waves-effect blue tooltipped" id="submit" data-tooltip="Guardar"><i class="material-icons">send</i></button>
    </div>
    </form>
</div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('cambionov.js');
?>