<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web     
Dashboard_Page::headerTemplate('Usuarios');
?> 

<div class="row">
    <div class="section container">      
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
    <div class="input-field center-align col s12 m4">
        <!-- Enlace para abrir la caja de dialogo (modal) al momento de crear un nuevo registro -->
        <a href="#" onclick="openCreateDialog()" class="btn waves-effect indigo tooltipped" data-tooltip="Crear"><i class="material-icons">add_circle</i></a>
    </div>
</div>
</div>

<!-- Tabla para mostrar los registros existentes -->
<table class="responsive-table highlight">
    <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
    <thead>
        <tr>
          
        <th>#</th>
        <th>Nombre </th>
        <th>Apellido </th>
        <th>Teléfono   </th>
        <th>Dirección   </th>
        <th>Correo   </th>
        <th>Estado </th>
        <th>Usuario </th>
        <th>Tipo empleado  </th>
        <th>Acciones </th>
        </tr>
    </thead>
    <!-- Cuerpo de la tabla para mostrar un registro por fila -->
    <tbody id="tbody-rows">
    </tbody>
</table>

<!-- Componente Modal para mostrar una caja de dialogo -->
<div id="save-modal" class="modal">
    <div class="modal-content">          
        <!-- Título para la caja de dialogo -->
        <h4 id="modal-title" class="center-align"></h4>
        <!-- Formulario para crear o actualizar un registro -->
        <form method="post" id="save-form" enctype="multipart/form-data">
            <!-- Campo oculto para asignar el id del registro al momento de modificar -->
            <input class="hide" type="number" id="idempleado" name="idempleado"/>
            <div class="row">
            <div class="input-field col s12 m6">
            <i class="material-icons prefix">person</i>
            <input id="nombreempleado" type="text" name="nombreempleado" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}"  class="validate" required/>
            <label for="nombreempleado">Nombre Empleado</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">person</i>
            <input id="apellidoempleado" type="text" name="apellidoempleado" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}"  class="validate" required/>
            <label for="apellidoempleado">Apellido Empleado</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">phone</i>
            <input id="telefonoempleado" type="text" name="telefonoempleado"  placeholder="0000-0000" pattern="[2,6,7]{1}[0-9]{3}[-][0-9]{4}" class="validate" required />
            <label for="telefonoempleado">Teléfono </label>
        </div>

        <div class="input-field col s12 m6">
          <i class="material-icons prefix">import_contacts</i>
          <input id="direccionempleado" type="text" name="direccionempleado" class="validate" required />
          <label for="direccionempleado">Dirección</label>
        </div>

        <div class="input-field col s12 m6">
            <i class="material-icons prefix">email</i>
            <input id="correoempleado" type="email" name="correoempleado" class="validate" required/>
            <label for="correoempleado">Correo Empleado</label>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">account_circle</i>                            
            <input id="usuario" type="text" name="usuario" class="validate" required/>
            <label for="usuario">Usuario</label>
            
        </div>  
        <div class="input-field col s12 m6">
                    <i class="material-icons prefix">security</i>
                    <input id="clave" type="password" name="clave" class="validate" required/>
                    <label for="clave">Clave</label>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">security</i>
                    <input id="confclave" type="password" name="confclave" class="validate" required/>
                    <label for="confclave">Confirmar clave</label>
                </div>
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">visibility</i>
          <input id="estadoempleado" type="text" name="estadoempleado" pattern="[1-2]{1}" class="validate" required />
          <label for="estadoempleado">Estado Cliente (1-Disponible, 2- Ocupado/Enfermo)</label>
        </div>
        
        <div class="input-field col s12 m6">
                <select  id="tipoempleado" name="tipoempleado">
            
                </select>
            <label>Tipo empleado</label>
        </div>
                </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
            </div>
        </form>
    </div>
</div>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('empleados.js');
?>  
