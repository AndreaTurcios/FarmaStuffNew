<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/public/plantillaHeaderLogin.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Login');
?>
<div class="container">
    <div class="row" >    
        <!-- Formulario para iniciar sesión -->
        <form method="post" id="codigo-form">
                <input id="nombres" type="text" name="nombres" class="hide"/>
                <input id="correocliente" type="text" name="correocliente" class="hide"/>
                <input id="codigo33" type="text" name="codigo33" class="hide"/>
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">person</i>
                <input id="codigos" type="text" name="codigos" class="validate"  onpaste="return false" required autocomplete="off"/>
                <label for="codigos">Verifique su Código </label>
            </div>           
            <div class="col s12 center-align">
                <button type="submit" id="envio1" name="envio1" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>                
            </div>            
        </form>
        
        <form method="post" id="pass-form">                
                <input id="correocliente" type="text" name="correosenvio" class="hide"/>
                <!-- <input id="codigo" type="text" name="codigo" class="hide"/> -->
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">lock</i>
                <input id="clave" type="password" name="clave" class="validate" oncopy="return false" oncut="return false" onpaste="return false" required autocomplete="off" required/>
                <label for="clave">Ingrese su Contraseña </label>
            </div>
            <div class="input-field col s12 m6 offset-m3">
                <i class="material-icons prefix">security</i>
                <input id="confirmacion" type="password" name="confirmacion" class="validate" oncopy="return false" oncut="return false" onpaste="return false" required autocomplete="off" required/>
                <label for="confirmacion">Confirme su contraseña </label>
            </div>           
            <div class="col s12 center-align">
                <button type="submit" id="envio2" name="envio2" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">send</i></button>                
            </div>            
        </form>
    </div>
</div>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('verificacion.js');
?>