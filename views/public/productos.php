<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/public_pages.php");
Public_Page::headerTemplate('Bienvenido');
?>
<!-- Contenedor para mostrar los producto de la categoría seleccionada previamente -->
<div class="container">
    <!-- Título del contenido principal -->
    <h4 class="center indigo-text" id="title"></h4>
    <!-- Fila para mostrar los productos disponibles por categoría -->
    <div class="row" id="productos"></div>
</div>
<?php
//Se incluye la plantilla del footer para la página web
Public_Page::footerTemplate('producto.js');
?>