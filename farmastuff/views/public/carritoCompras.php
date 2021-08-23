<?php
//Se incluye la plantilla del encabezado para la página web
include('../../app/helpers/public/public_pages.php');
Public_Page::headerTemplate('Órdenes');
?>

<div class="container">
    <h4 class="center-align indigo-text">Carrito de compras</h4>
    <table class="striped">
        <thead>
            <tr>
                <th>Nombre producto</th>
                <th>PRECIO (US$)</th>
                <th>CANTIDAD</th>
                <th>SUBTOTAL (US$)</th>
                <th class="actions-column">ACCIONES</th>
            </tr>
        </thead>
        <tbody id="tbody-rows">
        </tbody>
    </table>
    <div class="row right-align">
        <p>TOTAL A PAGAR (US$) <b id="pago"></b></p>
    </div>
    <div class="row right-align">
        <button type="button" onclick="finishOrder()" class="btn waves-effect blue tooltipped" data-tooltip="Finalizar pedido"><i class="material-icons">payment</i></button>
    </div>
    <div class="row right-align">
        <a href="index.php" class="btn waves-effect indigo tooltipped" data-tooltip="Seguir comprando"><i class="material-icons">store</i></a>
    </div>
</div>

<div id="item-modal" class="modal">
    <div class="modal-content">
        <h4 class="center-align">Cambiar cantidad</h4>
        <form method="post" id="item-form">
            <input type="number" id="id_detalle" name="id_detalle" class="hide"/>
            <div class="row">
                <div class="input-field col s12 m4 offset-m4">
                    <i class="material-icons prefix">list</i>
                    <input type="number" id="cantidad_producto" name="cantidad_producto" min="1" class="validate" required/>
                    <label for="cantidad_producto">Cantidad</label>
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
//Se incluye la plantilla del footer para la página web
Public_Page::footerTemplate('ordenCliente.js');
?>