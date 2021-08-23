<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/public_pages.php");
Public_Page::headerTemplate('Bienvenido');
?>

<!-- Contenedor para mostrar el detalle del producto seleccionado previamente -->
<div class="container">
    <!-- Título del contenido principal -->
    <h4 class="center indigo-text" id="title">Detalles del producto</h4>
    <div class="row" id="detalle">
        <!-- Componente Horizontal Card para mostrar el detalle de un producto -->
        <div class="card horizontal">
            <div class="card-image">
                <!-- Se muestra una imagen por defecto mientras se carga la imagen del producto -->
                <img id="imagen" src="../../resources/img/unknown.png">
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <h3 id="nombre" class="header"></h3>
                    <p id="descripcion"></p>
                    <p>Precio (US$) <b id="precio"></b></p>
                </div>
                <div class="card-action">
                    <!-- Formulario para agregar el producto al carrito de compras -->
                    <form method="post" id="shopping-form">
                        <!-- Campo oculto para asignar el id del producto -->
                        <input type="hidden" id="id_producto" name="id_producto"/>
                        <div class="row center">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">list</i>
                                <input type="number" id="cantidad_producto" name="cantidad_producto" min="1" class="validate" required/>
                                <label for="cantidad_producto">Cantidad</label>
                            </div>
                            <div class="input-field col s12 m6">
                                <button type="submit" class="btn waves-effect waves-light blue tooltipped" data-tooltip="Agregar al carrito"><i class="material-icons">add_shopping_cart</i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card horizontal">
      <div class="card-content">
        <form action="#" method="post" id="valoracion-form">
            <label>
                <p>
                 <input type="checkbox" id="e1" required/>
                <span>1 Estrella</span>
            </label>
            <label>
                <input type="checkbox" id="e2"/>
                <span>2 Estrellas</span>
            </label>
            <label>
               <input type="checkbox" id="e3"/>
               <span>3 Estrellas</span>
            </label>
            <label>
              <input type="checkbox" id="e4"/>
              <span>4 Estrellas</span>
            </label>
            <label>
              <input type="checkbox" id="e5" />
              <span>5 Estrellas</span>
            </label>
              <input type="hidden" id="valoracion" name="valoracion"/> 
              <input type="hidden" id="id_productos" name="id_productos"/>             
              <input type="hidden" id="usuario"  max="999" min="1"  name="usuario"/>             
            </p>
            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons center-align">save</i></button>                        
      </form>
      </div>
      </div>  
      <div class="card-action">
                    <!-- Formulario para agregar el producto al carrito de compras -->
                    <form method="post" id="Coment-form">
                        <!-- Campo oculto para asignar el id del producto -->
                        <input type="hidden" id="id_productoC" name="id_productoC"/>
                        <div class="row center">
                             <div class="input-field col s12">
                                <textarea id="Comentario" class="materialize-textarea"></textarea>
                                 <label for="Comentario">Comentario</label>
                                </div>
                            <div class="input-field col s12 m6">
                                <button type="submit" class="btn waves-effect waves-light blue tooltipped" data-tooltip="Ingresar"><i class="material-icons">add</i></button>
                            </div>
                        </div>
                    </form>
                </div>
</div>



<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Public_Page::footerTemplate('detalle.js');
?>