<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/loginPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Login');
?>
<div class="container">
    <div class="row" >
        <!-- Formulario para iniciar sesión -->
        <form method="post"  id="mail-form">
                <input id="nombres" type="text" name="nombres" class="hide"/>
                <input id="correo" type="text" name="correo" class="hide"/>
                <input id="codigosenviar" type="text" name="codigosenviar" class=""/>
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">email</i>
                <input id="correo_empleados" type="email" name="correo_empleados" class="validate" required/>
                <label for="correo_empleados">Correo Empleado</label>
            </div>           
            <div class="col s12 center-align">
                <button type="submit" id="envio" name="envio" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>                
            </div>            
        </form>  
    </div>
</div>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('recuperarclaves.js');
?>