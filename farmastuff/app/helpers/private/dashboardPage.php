<?php
//Clase para definir las plantillas de las páginas web del sitio privado
class Dashboard_Page {
    //Método para imprimir el encabezado y establecer el titulo del documento
    public static function headerTemplate($title) {
        session_start();
        print('
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <!--Se establece la codificación de caracteres para el documento-->
                <meta charset="utf-8">
                <!--Se importa la fuente de iconos de Google-->
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <!--Se importan los archivos CSS-->
                <link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css"/>
                <link type="text/css" rel="stylesheet" href="../../resources/css/style.css" />
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <!--Se informa al navegador que el sitio web está optimizado para dispositivos móviles-->
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <!--Título del documento-->
                <title>FarmaStuff - '.$title.'</title>
            </head>
            
            <body>
            ');

            //Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
        if (isset($_SESSION['idempleado'])) {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a main.php
            if ($filename != 'login.php' && $filename != 'register.php') {
                // Se llama al método que contiene el código de las cajas de dialogo (modals).
                //self::modals();
                // Se imprime el código HTML para el encabezado del documento con el menú de opciones.


                //Encabezado del documento

                print('
                <header>
                    <nav class="blue-grey darken-2">
                        <div class="nav-wrapper">
                        <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large">
                        <i class="material-icons">menu</i>
                        </a>  
                        <ul class="left left hide-on-med-and-down">
                           <li><a href="index.php"><i class="material-icons left">home</i>Home</a></li>
                        </ul>                       
                            <ul class="right right hide-on-med-and-down">
                                <li><a href="homePrivate.php"><i class="material-icons left">check</i>Revisar</a></li>
                                <li><a href="usuario.php"><i class="material-icons left">desktop_mac</i>Mantenimientos</a></li>
                                <li><a href="usuarioVentas.php"><i class="material-icons left">assignment</i>Órdenes</a></li>
                                <li><a href="empleadoMantenimiento.php"><i class="material-icons left">sentiment_very_satisfied</i>Valoraciones</a></li>
                                <li><a href="#" onclick="logOut()">Cerrar</a></li>                
                            </ul>
                        </div>  
                    </nav>
                    
                    <ul id="slide-out" class="sidenav">
                    <li>  
                        <div class="user-view">
                            <div class="background">
                                <img src="../../resources/img/fonfo12.jpg"> 
                            </div>
                            <a href="#user"><img class="circle" src="../../resources/img/default-user-image.png"></a>
                            <a href="#name"><span class="white-text name">Usuario: <b>' . $_SESSION['usuario'] . '</b></span></a>
                            <a href="#email"><span class="white-text email">Correo: <b>' . $_SESSION['correo'] . '</b></span></a>
                            
                        </div>
                    <li>
                        <li class="hide-on-large-only"><a href="index.php"><i class="material-icons left">home</i>Home</a></li>
                        <div class="divider hide-on-large-only"></div>                                                         
                    </li>                                               
                    </li>                    
                    <li>
                        <li><a href="empleadoMantenimiento.php"><i class="material-icons left">sentiment_very_satisfied</i>Valoraciones</a></li>                                           
                    </li>                     
                        <li><a href="homePrivate.php"><i class="material-icons left">check</i>Revisar</a></li>
                        <li><a href="usuario.php"><i class="material-icons left">desktop_mac</i>Mantenimiento</a></li>
                        <li><a href="usuarioVentas.php"><i class="material-icons left">assignment</i>Órdenes</a></li>
                        <li>
                        <div class="divider"></div>
                        </li> 
                        
                        <li><a href="#" onclick="changePassword()"><i class="material-icons left">key</i>Cambiar contraseña</a></li>
                        <li><a href="#" onclick="logOut()"><i class="material-icons left">highlight_off</i>Cerrar sesión</a></li>  
                </ul> 
                    <div id="change-modal" class="modal">
                        <div class="modal-content">          
                            <!-- Título para la caja de dialogo -->
                            <h4 id="modal-title" class="center-align"></h4>
                            <form id="change-form" method="post" enctype="multipart/form-data">
                                <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                                <input class="" type="number" id="idempleado" name="idempleado"/>
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">security</i>
                                        <input type="password" id="clavempleado" name="clavempleado" class="validate" required/>
                                        <label for="clavempleado">Clave</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">security</i>
                                        <input type="password" id="confclave" name="confclave" class="validate" required/>
                                        <label for="confclave">Confirmar clave</label>
                                    </div>
                                </div>
                                <div class="row center-align">
                                    <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                                    <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar" id="submit"><i class="material-icons">save</i></button>
                                </div>
                            </form>
                        </div>
                    </div>
    <script type="text/javascript" src="../../app/controllers/private/cambio.js"></script>
</header>  
');

} else {
    header('location: index.php');
}
} else {
// Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
if ($filename != 'login.php' && $filename != 'register.php') {
    header('location: login.php');
} else {
    // Se imprime el código HTML para el encabezado del documento con un menú vacío cuando sea iniciar sesión o registrar el primer usuario.
    print('
        <header>
            <!--NAVBAR-->
            <nav class="black">
                <div class="nav-wrapper container">
                    <a href="login.php" class="brand-logo">FarmaStuff</a>
                    <ul class="right hide-on-med-and-down">
                        <!--<li><a href="badges.html"><i class="material-icons right">exit_to_app</i>Iniciar sesión</a></li>-->
                    </ul>
                </div>
            </nav>
            <!--NAVBAR-->
        </header>
        ');
}
}
}

//Método para imprimir

public static function footerTemplate($controller)
{
    // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.
    if (isset($_SESSION['idempleado'])) {
        $scripts = '
        <!--Importación de archivos JavaScript al final del cuerpo para una carga optimizada-->
        <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script> 
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../../app/helpers/components.js"></script>                
        <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>              
        <script src="../../resources/js/init.js"></script>   
        <script type="text/javascript" src="../../app/controllers/private/account.js"></script>                                                          
        <script type="text/javascript" src="../../app/controllers/private/' . $controller . '"></script>
        ';
    } else {
        $scripts = '
        <!--Importación de archivos JavaScript al final del cuerpo para una carga optimizada-->
        <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script> 
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../../app/helpers/components.js"></script>                
        <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>              
        <script src="../../resources/js/init.js"></script>   
        <script type="text/javascript" src="../../app/controllers/private/account.js"></script>                                                          
        <script type="text/javascript" src="../../app/controllers/private/' . $controller . '"></script>
        ';
    }
    print('
 
            </body>
            <footer class="page-footer blue-grey darken-2">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Farmastuff Administrativo</h5>                               
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Sitio Público</h5>
                        <ul>
                            <a href="../public/index.php" class="card-title center-align white-text">Ir</a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2021 Copyright                            
                </div>
            </div>
        </footer>
                ' . $scripts . '
        </body>

        </html>
        ');
    }
}
/*  
                if (isset($_SESSION['idtipoempleado'])){
                        switch($_SESSION['idtipoempleado'])) {
                            case 1:
                                header('location: index.php')
                             break;

                             case2:
                                header('location: index.php')
                            break;

                            default: 
                    }
                }
*/
?>
