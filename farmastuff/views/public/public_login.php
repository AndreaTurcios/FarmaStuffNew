<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/plantillaHeader.php");
?>
<link href="../../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />

<div class="container">
  <div class="container-fluid">
            <form id='login' class="sign-box enters" method="post">
                <div class="sign-avatar">
                    <img src="../../resources/img/Originals/logoconpng.png" alt="">
                </div>
                <span><i class="fas fa-user-alt"></i> Inicio de sesión</span><br/>
            <div class="form-group">
                <input type="text" name="login" class="form-control" placeholder="Usuario"/>
            </div>
            <div class="form-group">
                <input type="password" name="pass" class="form-control" placeholder="Contraseña"/>
            </div>
              <p>
            <button type="submit" class="btn btn-info">Iniciar sesión</button>
        </p>
        <a href="#" class="reset">Olvidé mi contraseña</a>
        <div class="divider"></div>
        <a href="registroCliente.php" class="reset">Registrate</a>
        </form>
  </div>
</div>


<?php
//Se incluye la plantilla del footer para la página web
include("../../app/helpers/public/plantillaFooter.php");
?>