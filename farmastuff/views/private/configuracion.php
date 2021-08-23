<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Bienvenido');
?>  
<div class="container">
    <div class="row">

            <div class="col s12 m12 l12">
            <div class="card-panel">        
                    <div class="card-content">
                    <table>
                <thead>
                <tr>
                    <th>Mantenimiento</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td><a href="empleadoMantenimiento.php"  class="waves-effect waves-light btn">Empleados</a></td>
                </tr>
                <tr>
                <td><a href="#"  class="waves-effect waves-light btn">Repartidor</a></td>
                </tr>               
                <tr>
                <td><a href="#"  class="waves-effect waves-light btn">Proveedor</a></td>
                </tr>
                <tr>
                <td><a href="#"  class="waves-effect waves-light btn">Productos</a></td>
                </tr>
                <tr>                
                </tbody>
            </table>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('index.js');
?>