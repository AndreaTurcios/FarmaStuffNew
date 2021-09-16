<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Clientes');
?> 
<h4 style="text-align:center;"> Gestion de Clientes </h4>
<div class="section container">
<div class="row card-panel" style="text-align:center;">
<a href="#" onclick="openCreateDialog()" class="waves-effect waves-light btn-small modal-trigger"><i class="material-icons left">publish</i>Ingresar Cliente</a>
<a class="waves-effect waves-light btn-small"><i class="material-icons left">rotate_left</i>Actualizar lista</a>
    <form method="post" id="search-form">
        <div class="input-field col s6 m4">
            <i class="material-icons prefix">search</i>
            <input id="search" type="text" name="search" required/>
            <label for="search">Buscador</label>
        </div>
        <div class="input-field col s6 m4">
            <button type="submit" class="btn waves-effect green tooltipped" data-tooltip="Buscar"><i class="material-icons">check_circle</i></button>
        </div>
    </form>
</div>
</div> 
<div class="container">
<div class="row card-panel">
<br>

<table class="responsive-table highlight">
    <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
    <thead>
        <tr>
            <th>Nombre Cliente</th>      
            <th>Apellido Cliente</th>
            <th>Teléfono Cliente</th>            
            <th>DUI Cliente</th>
            <th>Dirección Cliente</th>
            <th>Correo Cliente</th>
            <th>Estado Cliente</th>
            <th class="actions-column">Acciones</th>
        </tr>
    </thead>
    <!-- Cuerpo de la tabla para mostrar un registro por fila -->
    <tbody id="tbody-rows">
    </tbody>
</table>



       <div id="show-modal" class="modal">
            <div class="modal-content center-align">
            <h4> </h4>                
                <h4 id="modal-title" class="center-align"></h4>                
                <form method="post" id="show-form">                   
                    <input class="hide" type="number" id="id_clienteO" name="id_clienteO"/>  
                    <input id="nombres_clientesO" type="text" name="nombres_clientesO"  class="hide" />
                    <div class="row">
                        <table class="responsive-table highlight">                           
                            <thead>
                                <tr>
                                    <th>Fecha Envío</th>      
                                    <th>Fecha Recibo</th>
                                    <th>Producto</th>            
                                    <th>Foto</th>
                                    <th>Precio Total</th>
                                    <th>Costo Envío</th>
                                    <th>Cantidad</th>                                  
                                </tr>
                            </thead>                            
                            <tbody id="Order-rows">
                            </tbody>
                        </table>
                    <div class="row center-align">                    
                    </div>           
                </form>
            </div>            
        </div>
        </div> 

      


        <div id="save-modal" class="modal">
            <div class="modal-content center-align">
            <h4> </h4>
                <!-- Título para la caja de dialogo -->
                <h4 id="modal-title" class="center-align"></h4>
                <!-- Formulario para crear o actualizar un registro -->
                <form method="post" id="save-form">
                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                    <input class="hide" type="number" id="id_cliente" name="id_cliente"/>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">person</i>
                            <input id="nombres_clientes" type="text" name="nombres_clientes"  pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required/>
                            <label for="nombres_clientes">Nombre Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">person</i>
                            <input id="apellidos_clientes" type="text" name="apellidos_clientes" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required/>
                            <label for="apellidos_clientes">Apellido Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">email</i>
                            <input id="correo_clientes" type="email" name="correo_clientes" class="validate" maxlength="100" required oncopy="return false" oncut="return false" onpaste="return false" required autocomplete="off"/>
                            <label for="correo_clientes">Correo Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">phone</i>
                            <input id="telefono_clientes" type="tel" name="telefono_clientes" class="validate" placeholder="0000-0000" pattern="[2,6,7]{1}[0-9]{3}[-][0-9]{4}" required oncopy="return false" oncut="return false" onpaste="return false" required autocomplete="off"/>
                            <label for="telefono_clientes">Teléfono Cliente</label>
                        </div>                       
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">badge</i>
                            <input id="dui_clientes" type="text" name="dui_clientes" class="validate" placeholder="00000000-0" pattern="[0-9]{8}[-][0-9]{1}" required oncopy="return false" oncut="return false" onpaste="return false" required autocomplete="off"/>
                            <label for="dui_clientes">Dui Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>                            
                            <input id="direccion_clientes" type="text" name="direccion_clientes" class="validate" required/>
                            <label for="direccion_clientes">Direccion</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <select id="estado_clientes" name="estado_clientes">
                            </select>
                            <label>Estado</label>
                         </div>                                            
                    </div>
                    <div class="row center-align">
                        <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                    </div>           
                </form>
            </div>            
        </div>

        
    </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('cliente.js');
?>  
