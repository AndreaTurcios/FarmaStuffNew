<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Proveedores');
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
            <th>Compañía </th>
            <th>Representante</th>
            <th>Teléfono proveedor </th>
            <th>Dirección proveedor</th>
            <th>Acciones</th>
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
            <input class="hide" type="number" id="id" name="id" />
          <div class="row">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">corporate_fare</i>
              <input id="nombre_compania" type="text" name="nombre_compania" class="validate" required />
              <label for="nombre_compania">Nombre Compañía</label>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">person</i>
              <input id="representante" type="text" name="representante" class="validate" required />
              <label for="representante">Representante</label>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">import_contacts</i>
              <input id="direccion_proveedor" type="text" name="direccion_proveedor" class="validate" required />
              <label for="direccion_proveedor">Dirección Proveedor</label>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">phone</i>
              <input id="telefono_proveedor" type="tel" name="telefono_proveedor" class="validate" required />
              <label for="telefono_proveedor">Teléfono Proveedor</label>
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
Dashboard_Page::footerTemplate('proveedor.js');
?>