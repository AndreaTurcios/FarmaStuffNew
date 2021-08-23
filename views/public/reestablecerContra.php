<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/plantillaHeader.php");
?>
<link href="../../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />

<div class="container">
  <div class="container-fluid">
            <form id='login' class="sign-box enters" method="post">
                <h5> Restablecimiento de contraseña </h5>
                <div class="sign-avatar">
                    <img src="../../resources/img/Candado.png" alt="">
                </div>
                <div class="input-field col s12">
                    <input type="password" id="password" clas="validate" required >
                    <label for="password">Contraseña: </label>
                </div>
                <div class="input-field col s12">
                    <input type="password" id="password1" clas="validate" required >
                    <label for="password1">Confirmar Contraseña: </label>
                </div>
         <p>
            <button type="submit" class="btn btn-info">Enviar correon</button>
        </p>
       
  </div>
</div>


<?php
//Se incluye la plantilla del footer para la página web
include("../../app/helpers/public/plantillaFooter.php");
?>