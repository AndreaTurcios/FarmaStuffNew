<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS de sticky footer-->
    <link type="text/css" rel="stylesheet" href="../../resources/css/style.css">
    <!--Título-->
    <title>FarmaStuff - Primer uso</title>
</head>

<body>
    <header>
        <!--NAVBAR-->
        <nav class="blue-grey darken-2">
            <div class="nav-wrapper container">
                <a href="index.php" class="brand-logo">FarmaStuff</a>
                <ul class="right hide-on-med-and-down">
                </ul>
            </div>
        </nav>
        <!--NAVBAR-->
    </header>

    <main>
        <!--TITULO-->
        <div class="section white">
            <div class="row container">
                <h4 class="header center-align mbottom-30">PRIMER USUARIO</h4>
            </div>
        </div>
        <!--TITULO-->

        <!--AGREGAR-->
        <!-- Contenedor para mostrar el formulario de registro de clientes -->
        <div class="container">
            <!-- Formulario para crear el primer usuario o empleado -->
            <form method="post" id="register-form">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">person</i>
                        <input id="nombreempleado" type="text" name="nombreempleado" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required />
                        <label for="nombreempleado">Nombre Empleado</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">person</i>
                        <input id="apellidoempleado" type="text" name="apellidoempleado" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required />
                        <label for="apellidoempleado">Apellido Empleado</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">phone</i>
                        <input id="telefonoempleado" type="text" name="telefonoempleado" placeholder="0000-0000" pattern="[2,6,7]{1}[0-9]{3}[-][0-9]{4}" class="validate" required />
                        <label for="telefonoempleado">Teléfono </label>
                    </div>

                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">import_contacts</i>
                        <input id="direccionempleado" type="text" name="direccionempleado" class="validate" required />
                        <label for="direccionempleado">Dirección</label>
                    </div>

                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">email</i>
                        <input id="correoempleado" type="email" name="correoempleado" class="validate" required />
                        <label for="correoempleado">Correo Empleado</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="usuario" type="text" name="usuario" class="validate" required />
                        <label for="usuario">Usuario</label>

                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">security</i>
                        <input id="clave" type="password" name="clave" class="validate" required />
                        <label for="clave">Clave</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">security</i>
                        <input id="confclave" type="password" name="confclave" class="validate" required />
                        <label for="confclave">Confirmar clave</label>
                    </div>

                    <!--El estado del primero usuario y el tipo de usuario son por defecto , estado= activo(1) 
                    tipo de usuario o empleado = administrador(1)-->

                    <!--Botón para registrar al primer usuario-->

                    <div class="row center-align">
                        <div class="col s12">
                            <button type="submit" class="btn waves-effect waves-light tooltipped" data-tooltip="Registrar"><i class="material-icons left">person</i>Registrarme</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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

    <!--Se cargan todos los archivos que se van a utilizar-->


    <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../app/helpers/components.js"></script>
    <script type="text/javascript" src="../../app/controllers/private/register.js"></script>


</body>

</html>
