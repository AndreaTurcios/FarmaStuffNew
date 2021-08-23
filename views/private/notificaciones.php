<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Bienvenido');
?>  
<div class="container">
    <div class="row">
    <div class="col s12 m12 l12 right" >
            <div class="card horizontal" >      
                <div class="card-stacked">
                    <span class="card-title center-align">notificaciones</span>
                    <div class="card-content">      
                    <div class="row">
                    
                    <div class="col s12 m6">
                        <div class="card horizontal">
                            <div class="card-content center-align ">
                            <span class="card-title">Inserción en Proveedores</span>
                            <p>I am a very simple card. I am good at containing small bits of information.
                            I am convenient because I require little markup to use effectively.</p>
                            </div>
                            <div class="card-action bottom">
                             <a href="#">Verificar</a>
                            </div>
                        </div>
                    </div>                                
                    <div class="col s12 m6">
                        <div class="card horizontal">
                            <div class="card-content center-align">
                            <span class="card-title">Actualización de Productos</span>
                            <p>I am a very simple card. I am good at containing small bits of information.
                            I am convenient because I require little markup to use effectively.</p>
                            </div>
                            <div class="card-action bottom">
                            <a href="#">Verificar</a>                            
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
Dashboard_Page::footerTemplate('index.js');
?>