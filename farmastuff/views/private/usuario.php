<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Mantenimientos');
?>  
<div class='main-container'>
     <div class='row'>           
        <div class="col s12 m12 l12 center" >
            <div class="card horizontal" >      
                <div class="card-stacked center">
                    <span class="card-title center-align">Mantenimientos</span>
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12 m2">
                                    <div class="card center-align" >
                                        <i class="large material-icons">person</i>
                                            <div class="card-block">
                                                <br></br>
                                                <a href="UsuarioAdminUsu.php" class="card-title center-align">Empleado</a>                                                        
                                                <br>
                                            </div>
                                    </div>
                                </div>                
                                <div class="col s12 m2">
                                    <div class="card center-align" >
                                        <i class="large material-icons">face</i>
                                            <div class="card-block">
                                                <br></br>
                                                <a href="UsuarioAdminCli.php" class="card-title text-center">Cliente</a>                                                        
                                                <br>
                                            </div>
                                        </div>
                                    </div>                

                                    <div class="col s12 m2">
                                        <div class="card center-align" >
                                                <i class="large material-icons">local_shipping</i>
                                                    <div class="card-block">
                                                        <br></br>
                                                        <a href="proveedor.php" class="card-title text-center">Proveedor</a>                                                        
                                                        <br>                                     
                                                    </div>    
                                        </div>
                                    </div>                
                                    <div class="col s12 m2">
                                        <div class="card center-align" >
                                            <i class="large material-icons">shopping_bag</i>
                                                <div class="card-block">
                                                    <br></br>
                                                    <a  href="UsuarioBodeguero.php" class="card-title text-center">Productos</a>                                                    
                                                    <br>
                                                </div>
                                        </div>                              
                                    </div>
                                </div>                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('init.js');
?>