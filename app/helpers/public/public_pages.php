<?php
//Clase para definir las plantillas de las páginas web del sitio público
class Public_Page {
    //Método para imprimir el encabezado y establecer el titulo del documento
    public static function headerTemplate($title) {
        session_start();
       
$filename = basename($_SERVER['PHP_SELF']);

if (isset($_SESSION['idcliente'])) {
    print('
    <!doctype html>
    <html lang="es">
    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
        <title>FarmaStuff</title>
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../../resources/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <link href="../../resources/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- Googlefont -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <nav class="rgb(202, 104, 104)" role="navigation">
            <div class="nav-wrapper container nav">
                <a class="navbar-brand" href="#">
                    <a href="#" data-target="nav-mobile" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
                    <img src="../../resources/img/logoconpng.png" width="95" height="70" class="left">
                    <a id="logo-container" href="#" class="brand-logo left-align">
                        <i class="material-icons" style="font-style: oblique;"></i>
                        <a href="../../views/public/index.php" class="right-align"> 
                        <font color="#fff9c4" size="5" face="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg">FarmaStuff</font>
                        </a>
                    </a>
       
                    
    
                    <ul class="right hide-on-med-and-down">
                        <li><a href="../../views/public/quienesSomos.php">Conócenos</a></li>
                        <li><a href="../../views/public/sucursales.php">Sucursales</a></li>
                       
                        <li><a href="#name"><span class="white-text name">Usuario: <b>' . $_SESSION['usuariocliente'] . '</b></span></a></li>                        
                        <li><input type="hidden"  id="users" name="users" value="'. $_SESSION['usuariocliente'] .'"/> </li>
                        <a href="../../app/reports/private/pedidofinal.php? target="_blank" class="btn waves-effect pink tooltipped" data-tooltip="Orden Final"><i class="material-icons">assignment</i></a>   
                        <li><a href="#" onclick="logOut()">Salir</a></li>
                    </ul>
    
                    <ul id="nav-mobile" class="sidenav">
                        <li><a href="../../views/public/quienesSomos.php">Conócenos</a></li>
                        <li><a href="../../views/public/sucursales.php">Sucursales</a></li>
                        <li><a href="../../views/public/login.php" class="btn red black-text waves-effect waves-blue-grey lighten-1">Iniciar sesión</a></li>
                        <hr>
                        <li><a href="../../views/public/receta.php">Compra con receta</a></li>
                        <li><a href="../../views/public/recetaConSeguro.php">Compra con seguro</a></li>
                        
                        <hr>
                        <ul id="dropdown1" class="dropdown-content">
                            <li><a href="#!">Medicinal</a></li>
                            <li><a href="#!">Conveniencia</a></li>
                        </ul>
                        <li>
                            <!-- Dropdown Trigger -->
                            <li><a class="dropdown-trigger btn disabled" href="#!" data-target="dropdown1">Categorías<i class="material-icons right">arrow_drop_down</i></a></li>
                        </li>
                        <li><a href="../../views/public/receta.php" style="color:black;">Compra con receta</a></li>
                        <li><a href="../../views/public/recetaConSeguro.php" style="color:black;">Compra con seguro</a></li>
                    </ul>
            </div>
        </nav>
        <div class="navbars">
        </div>
        <div class="navbarsecond">
        </div>
    
        <nav class="red lighten-5" role="navigation">
            <div class="nav-wrapper container nav">
                <center>
                    <ul class="right hide-on-med-and-down">
                        <!-- Dropdown Structure -->
                        <ul id="dropdown1" class="dropdown-content">
                            <li><a href="#!">Medicinal</a></li>
                            <li><a href="#!">Conveniencia</a></li>
                            <li class="divider"></li>
                            <li><a href="../../views/public/ofertas.php">Ofertas</a></li>
                        </ul>
                        <li>
                            <!-- Dropdown Trigger -->
                            <li><a class="dropdown-trigger btn red lighten-2" href="#!" data-target="dropdown1">Categorías<i class="material-icons right">arrow_drop_down</i></a></li>
                        </li>
                        <li><a href="../../views/public/ofertas.php" style="color:black;">Ofertas</a></li>
                        <li><a href="../../views/public/receta.php" style="color:black;">Compra con receta</a></li>
                        <li><a href="../../views/public/recetaConSeguro.php" style="color:black;">Compra con seguro</a></li>
                        <!--<li><input type="text" class="searchTerm" placeholder="Buscar producto..."></li>
                        <li><a href="#" class="btn-floating"><i class="material-icons">search</i></a></li>-->
                        <li><a href="carritoCompras.php" class="red lighten-2 waves-effect waves-light red btn btn-floating btn btn-danger "><i class="material-icons" style="font-style: unset;">add_shopping_cart</i></a></li>
                    </ul>
                    
                    <ul id="nav-mobile" class="sidenav">
                        <li><a href="../../views/public/ofertas.php" style="color:black;">Ofertas</a></li>
                        <li><a href="../../views/public/receta.php" style="color:black;">Compra con receta</a></li>
                        <li><a href="../../views/public/recetaConSeguro.php" style="color:black;">Compra con seguro</a></li>
                    </ul>
                </center>
            </div>
        </nav>
<section class="slider">
            <ul class="slides">
                <li>
                    <img src="../../resources/img/img1.jpg">
                    <div class="caption center-align">
                        <h1>La mejor farmacia</h3>
                            <h5 class="light grey-text text-lighten-3">FarmaStuff es la página en línea de productos farmaceuticos más popular.</h5>
                            <a href="#" class="btn btn-large white black-text waves-effect waves-grey">Más información</a>
                    </div>
                </li>
                <li>
                    <img src="../../resources/img/img3.png">
                    <div class="caption left-align">
                        <h3>Con millones de proovedores alrededor del mundo</h3>
                        <h5 class="light grey-text text-lighten-3">FarmaStuff cuenta con proveedores extranjeros y a nivel nacional, por lo que se encuentra una variedad de productos extensa.</h5>
                        <a href="#" class="btn btn-large white black-text waves-effect waves-grey">Más información</a>
                    </div>
                </li>
                <li>
                    <img src="../../resources/img/img2.png">
                    <div class="caption right-align">
                        <h3>Con una extensa variedad de productos</h3>
                        <h5 class="light grey-text text-lighten-3">Más de 3 mil productos de millones de proveedores, ya sea internacionales, o nacionales.</h5>
                        <a href="#" class="btn btn-large white black-text waves-effect waves-grey">Más información</a>
                    </div>
                </li>
    
            </ul>
        </section>
        <form method="post" id="search-form">
        <div class="input-field col s6 m6">
           <i class="material-icons prefix">search</i>
           <input id="search" type="text" name="search" required/>
           <label for="search">Buscador</label>
        </div>
           <div class="input-field col s6 m4">
               <button type="submit" class="btn waves-effect green tooltipped" data-tooltip="Buscar"><i class="material-icons">check_circle</i></button>
           </div>
       </form>

        <main>

');            }

else {
print('
<!doctype html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <title>FarmaStuff</title>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../../resources/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="../../resources/css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Googlefont -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="rgb(202, 104, 104)" role="navigation">
        <div class="nav-wrapper container nav">
            <a class="navbar-brand" href="#">
                <a href="#" data-target="nav-mobile" class="sidenav-trigger left"><i class="material-icons">menu</i></a>
                <img src="../../resources/img/logoconpng.png" width="95" height="70" class="left">
                <a id="logo-container" href="#" class="brand-logo left-align">
                    <i class="material-icons" style="font-style: oblique;"></i>
                    <a href="../../views/public/index.php" class="right-align"> 
                    <font color="#fff9c4" size="5" face="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg">FarmaStuff</font>
                    </a>
                </a>

                

                <ul class="right hide-on-med-and-down">
                    <li><a href="../../views/public/quienesSomos.php">Conócenos</a></li>
                    <li><a href="../../views/public/sucursales.php">Sucursales</a></li>
                    <li><a href="../../views/public/login.php" class="btn white black-text waves-effect waves-blue-grey lighten-1">Iniciar sesión</a></li>
                </ul>

                <ul id="nav-mobile" class="sidenav">
                    <li><a href="../../views/public/quienesSomos.php">Conócenos</a></li>
                    <li><a href="../../views/public/sucursales.php">Sucursales</a></li>
                    <li><a href="../../views/public/login.php" class="btn red black-text waves-effect waves-blue-grey lighten-1">Iniciar sesión</a></li>
                    <hr>
                    <li><a href="../../views/public/receta.php">Compra con receta</a></li>
                    <li><a href="../../views/public/recetaConSeguro.php">Compra con seguro</a></li>
                    
                    <hr>
                    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="#!">Medicinal</a></li>
                        <li><a href="#!">Conveniencia</a></li>
                        <li class="divider"></li>
                        <li><a href="../../views/public/ofertas.php">Ofertas</a></li>
                    </ul>
                    <li>
                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-trigger btn disabled" href="#!" data-target="dropdown1">Categorías<i class="material-icons right">arrow_drop_down</i></a></li>
                    </li>
                    <li><a href="../../views/public/ofertas.php" style="color:black;">Ofertas</a></li>
                    <li><a href="../../views/public/receta.php" style="color:black;">Compra con receta</a></li>
                    <li><a href="../../views/public/recetaConSeguro.php" style="color:black;">Compra con seguro</a></li>
                </ul>
        </div>
    </nav>
    <div class="navbars">
    </div>
    <div class="navbarsecond">
    </div>

    <nav class="red lighten-5" role="navigation">
        <div class="nav-wrapper container nav">
            <center>
                <ul class="right hide-on-med-and-down">
                    <!-- Dropdown Structure -->
                    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="#!">Medicinal</a></li>
                        <li><a href="#!">Conveniencia</a></li>
                        <li class="divider"></li>
                        <li><a href="../../views/public/ofertas.php">Ofertas</a></li>
                    </ul>
                    <li>
                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-trigger btn red lighten-2" href="#!" data-target="dropdown1">Categorías<i class="material-icons right">arrow_drop_down</i></a></li>
                    </li>
                    <li><a href="../../views/public/ofertas.php" style="color:black;">Ofertas</a></li>
                    <li><a href="../../views/public/receta.php" style="color:black;">Compra con receta</a></li>
                    <li><a href="../../views/public/recetaConSeguro.php" style="color:black;">Compra con seguro</a></li>
                    <li><a href="carritoCompras.php" class="red lighten-2 waves-effect waves-light red btn btn-floating btn btn-danger "><i class="material-icons" style="font-style: unset;">add_shopping_cart</i></a></li>
                </ul>
                
                <ul id="nav-mobile" class="sidenav">
                    <li><a href="../../views/public/ofertas.php" style="color:black;">Ofertas</a></li>
                    <li><a href="../../views/public/receta.php" style="color:black;">Compra con receta</a></li>
                    <li><a href="../../views/public/recetaConSeguro.php" style="color:black;">Compra con seguro</a></li>
                </ul>
            </center>
        </div>
    </nav>
<section class="slider">
        <ul class="slides">
            <li>
                <img src="../../resources/img/img1.jpg">
                <div class="caption center-align">
                    <h1>La mejor farmacia</h3>
                        <h5 class="light grey-text text-lighten-3">FarmaStuff es la página en línea de productos farmaceuticos más popular.</h5>
                        <a href="#" class="btn btn-large white black-text waves-effect waves-grey">Más información</a>
                </div>
            </li>
            <li>
                <img src="../../resources/img/img3.png">
                <div class="caption left-align">
                    <h3>Con millones de proovedores alrededor del mundo</h3>
                    <h5 class="light grey-text text-lighten-3">FarmaStuff cuenta con proveedores extranjeros y a nivel nacional, por lo que se encuentra una variedad de productos extensa.</h5>
                    <a href="#" class="btn btn-large white black-text waves-effect waves-grey">Más información</a>
                </div>
            </li>
            <li>
                <img src="../../resources/img/img2.png">
                <div class="caption right-align">
                    <h3>Con una extensa variedad de productos</h3>
                    <h5 class="light grey-text text-lighten-3">Más de 3 mil productos de millones de proveedores, ya sea internacionales, o nacionales.</h5>
                    <a href="#" class="btn btn-large white black-text waves-effect waves-grey">Más información</a>
                </div>
            </li>

        </ul>
    </section>
    <form method="post" id="search-form">
    <div class="input-field col s6 m6">
       <i class="material-icons prefix">search</i>
       <input id="search" type="text" name="search" required/>
       <label for="search">Buscador</label>
    </div>
       <div class="input-field col s6 m4">
           <button type="submit" class="btn waves-effect green tooltipped" data-tooltip="Buscar"><i class="material-icons">check_circle</i></button>
       </div>
   </form>
    <main>
');
        }
    }
        
    //Método para imprimir el pie y establecer el controlador del documento
    public static function footerTemplate($controller) {
        print('
                </main>
                <!--Pie del documento-->
                

                <footer class="page-footer #e57373">
                </div>
                    </div>
                        <br>
                        <div class="container center footer-text">
                        <b>Enlaces de interés</b>
                        <br>
                        ---
                    </div>
                            <center>
                             <button type="submit" style="background-color: #ef9a9a " class="btn btn-primary btn-xs">Contacto</button>
                             <button type="submit" style="background-color: #ef9a9a" class="btn btn-primary btn-xs">Enlaces</button>
                             <button type="submit" style="background-color: #ef9a9a" class="btn btn-primary btn-xs">Proveedores</button>
                             <button type="submit" style="background-color: #ef9a9a" class="btn btn-primary btn-xs">Red de médicos</button>
                             <button type="submit" style="background-color: #ef9a9a" class="btn btn-primary btn-xs">Términos y condiciones</button>
                            </center>
                                    <div class="row pb-3">
                                        <div class="col-md-12">
                                            <br>
                                            <center>
                                            <div class="aside">
                                                <a title="Facebook" href="https://es-la.facebook.com/"><img src="../../resources/img/facebook_icon-icons.com_53612.png" width="50" height="50"></a>
                                                <a title="Instagram" href="https://www.instagram.com/Farma_Stuff"><img src="../../resources/img/Instagram_icon-icons.com_66804.png" width="50" height="50"></a>
                                                <a title="Twitter" href="https://twitter.com/?lang=es"><img src="../../resources/img/5294-twitter-i_102511.png" width="50" height="50"></a>
                                            </div>
                                        </center>
                                        </div>
                                    </div>
                                </div>

<!--  En esta zona va el copyright de la página-->
<div class="footer-copyright">
    <div class="container center footer-text">
        &copf; FarmaStuff - 2021
    </div>
</div>
</footer>
                <!--Importación de archivos JavaScript al final del cuerpo para una carga optimizada-->
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script> 
                <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>                
                <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>              
                <script src="../../resources/js/init.js"></script>
                <script type="text/javascript" src="../../app/controllers/public/account.js"></script>
                <script type="text/javascript" src="../../app/controllers/public/' . $controller . '"></script>
                
            </body>
            </html>
        ');
    }
}
?>