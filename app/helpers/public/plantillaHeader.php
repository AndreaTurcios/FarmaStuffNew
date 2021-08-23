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
                            <li><a href="../../views/public/ofertas.php">Ofertas</a></li>
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
                            <li><input type="text" class="searchTerm" placeholder="Buscar producto..."></li>
                            <li><a href="#" class="btn-floating"><i class="material-icons">search</i></a></li>
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
        