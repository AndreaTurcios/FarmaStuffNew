<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/plantillaHeaderLogin.php");
Dashboard_Page::headerTemplate('Login');
?>


<div class="container">
    <div class="row" >
        <!-- Formulario para iniciar sesión -->
        <form method="post"  id="mail-form">
                <input id="nombres" type="text" name="nombres" class="hide"/>
                <input id="correo" type="text" name="correo" class="hide"/>
                <input id="codigosenviar" type="text" name="codigosenviar" class="hide"/>
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">email</i>
                <input id="correocliente" type="email" name="correocliente" class="validate" required/>
                <label for="correocliente">Correo cliente</label>
            </div>           
            <div class="col s12 center-align">
                <button type="submit" id="envio" name="envio" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>                
            </div>            
        </form>  
    </div>
</div>

<?php
//Se incluye la plantilla del footer para la página web
Dashboard_Page::footerTemplate('verificars.js');
?>