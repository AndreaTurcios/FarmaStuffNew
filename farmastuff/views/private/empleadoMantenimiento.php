<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Valoraciones');
?>  <div class="row" >
<div class="section container">      
<form method="post" id="search-form">
<h4>Valoraciones y comentarios</h4>
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

<!-- Tabla para mostrar los registros existentes -->
<table class="responsive-table highlight">
<!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
<thead>
    <tr>
      
    <th>#</th>    
    <th>Comentario </th>
    <th>Cliente </th>
    <th>N° Estrellas (1-5)</th>
    <th>Producto</th>
    <th>Estado</th>
    <th>Acciones</th>
    </tr>
</thead>
<!-- Cuerpo de la tabla para mostrar un registro por fila -->
<tbody id="tbody-rows">
</tbody>
</table>

<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('edit_usuario.js');
?>                              