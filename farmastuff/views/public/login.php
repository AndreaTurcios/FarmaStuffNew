<?php
//Se incluye la plantilla del encabezado para la página web
include('../../app/helpers/public/plantillaHeaderLogin.php');
Dashboard_Page::headerTemplate('Login');
?>
     
<link href="../../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
  
<div class="container">
  <div class="container-fluid">
            <form  method="post" id="session-form" class="sign-box enters" >
                <div class="sign-avatar">
                    <img src="../../resources/img/Originals/logoconpng.png" alt="">
                </div>
                <span><i class="fas fa-user-alt"></i> Inicio de sesión</span><br/>
            <div class="form-group">
                <input id="usuariocliente" type="text" name="usuariocliente" class="validate" required/>
            </div>
            <div class="form-group">
                <input id="clavecliente" type="password" name="clavecliente" class="validate" required/>
            </div>
              <p>
              <div class="col s12 center-align">
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Ingresar">Iniciar sesión <i class="material-icons">send</i></button>
            </div>
        </p>
        <div class="divider"></div>
        <a href="registroCliente.php" class="reset">Registrate</a>
        </form>
  </div>
</div>


<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('login.js');
?>