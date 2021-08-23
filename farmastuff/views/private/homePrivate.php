<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Revisión de productos');
?>  
<div class="main-container"> 
    <div class="row">                
          <div class="col s12 m12 l12" >
            <div class="card horizontal" >      
                <div class="card-stacked">
                    <span class="card-title center-align">Productos sin revisar</span>
                    <div class="card-content">                                    
                    <div class="col s12 m12 l12">
                    <table class="responsive-table highlight">
                        <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
                        <thead>
                            <tr>
                                <th>Nombre Producto</th>                                      
                                <th>Existencias</th>            
                                <th>Cantidad por Unidad</th>                                
                                <th>Foto Producto</th>
                                <th>Estado Producto</th>                                
                                <th>Proveedor</th>                                
                                <th>Codigo Producto</th> 
                                <th class="actions-column">Acciones</th>
                            </tr>
                        </thead>
                        <!-- Cuerpo de la tabla para mostrar un registro por fila -->
                         <tbody id="rev-rows">
                        </tbody>
                    </table>
                    </div>
                </div>                    
                </div>
                </div>
                  

        <div id="save-modal" class="modal">
            <div class="modal-content center-align">
            <h4></h4>
                <!-- Título para la caja de dialogo -->
                <h4 id="modal-title" class="center-align"></h4>
                <!-- Formulario para crear o actualizar un registro -->
                <form method="post" id="save-form">
                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                    <input class="hide" type="number" id="id_productoR1" name="id_productoR1"/>
                    <div class="row">                        
                        <div class="input-field col s12 m6 hide">                            
                            <input id="nombre_producto" type="numeric" name="nombre_producto"  value=''/>
                            <label class="hide" for="nombre_producto">Nombre Producto</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">inventory_2</i>
                            <input id="existencia_producto" type="number" name="existencia_producto" class="validate" max="999" min="1" step="any"  required/>
                            <label for="existencia_producto">Existencias</label>
                        </div>                                               
                         <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons center-align">cancel</i></a>
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons center-align">save</i></button>                                
                        </div>
                    </div>           
                </form>
            </div>            
        </div>
  	</div>
</div>

    </div>
</div>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('revision.js');
?>