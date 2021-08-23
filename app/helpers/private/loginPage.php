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
                <title>Dashboard - '.$title.'</title>
            </head>
            
            <body>
                <!--Encabezado del documento-->
                <header>
                    <nav class="blue-grey darken-2">
                        <div class="nav-wrapper">
                        
                        </div>  
                    </nav>

                    <ul id="slide-out" class="sidenav">
                    <li>
                        <div class="user-view">
                            <div class="background">
                                <img src="../../resources/img/fonfo12.jpg">
                            </div>
                            <a href="#user"><img class="circle" src="../../resources/img/default-user-image.png"></a>
                            <a href="#name"><span class="white-text name">Aurelio Napoleón Capablanca Mazzini</span></a>
                            <a href="#email"><span class="white-text email">ArwenKonne@gmail.com</span></a>
                            <a href="#rank"><span class="white-text name">Administrador</span></a>
                        </div>
                    <li>
                        <li class="hide-on-large-only"><a href="index.php"><i class="material-icons left">dashboard</i>Dashboard</a></li>
                        <div class="divider hide-on-large-only"></div>                                                         
                    </li>                                               
                    </li>                    
                    <li>
                        <li><a href="empleadoMantenimiento.php"><i class="material-icons left">person</i>Cambiar Datos</a></li>
                        <li><a href="homePrivate.php"><i class="material-icons left">comment</i>Configuracion</a></li>                                                        
                    </li>                         
                    <li>
                        <div class="divider"></div>
                    </li>                    
                        <li class="hide-on-large-only" ><a href="homePrivate.php"><i class="material-icons left">home</i>Revisar</a></li>
                        <li class="hide-on-large-only"><a href="usuario.php"><i class="material-icons left">person</i>Mantenimiento</a></li>
                        <li class="hide-on-large-only"><a href="usuarioVentas.php"><i class="material-icons left">euro_symbol</i>Ordenes</a></li>
                </ul> 


                


                </header>
                <!--Contenido principal del documento-->
                <main>
        ');
    }

    //Método para imprimir el pie y establecer el controlador del documento
    public static function footerTemplate($controller) {
        print('
                </main>
                <!--Pie del documento-->
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
                <!--Importación de archivos JavaScript al final del cuerpo para una carga optimizada-->
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script> 
                <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>                
                <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>              
                <script src="../../resources/js/init.js"></script>                
                <script type="text/javascript" src="../../app/controllers/private/' . $controller . '"></script>
            </body>
            </html>
        ');
    }
}
?>