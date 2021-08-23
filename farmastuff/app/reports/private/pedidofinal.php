<?php
require('../../helpers/report.php');
require('../../models/clientes.php');

// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReports('Detalle de Una Orden');

// Se instancia el módelo Categorías para obtener los datos.
$cliente = new Clientes;
// Se verifica si existen registros (categorías) para mostrar, de lo contrario se imprime un mensaje.
if ($dataCliente = $cliente->readOneFinal()) { 
  if ($dataPedido = $cliente->readOrdenFinal()) {
        // Se recorren los registros ($dataCategorias) fila por fila ($rowCategoria).
        $pdf->SetFillColor(225);
        //
        $pdf->Cell(0, 10, utf8_decode('Número de Orden: '.'#'.$dataCliente['idorden']), 0, 0, 'C', 0);    
        $pdf->Ln();
        $pdf->Cell(0, 10, utf8_decode('Nombre del Cliente: '.$dataCliente['nombrecliente'].' '.$dataCliente['apellidocliente']), 0, 0, 'C', 0);    
        $pdf->Ln();
        $pdf->Cell(0, 10, utf8_decode('Fecha de Envío: '.$dataCliente['fechaenvio']), 0, 0, 'C', 0);    
        $pdf->Ln();
        $pdf->Cell(0, 10, utf8_decode('Fecha de Recibido: '.$dataCliente['fecharecibo']), 0, 0, 'C', 0);    
        $pdf->Ln();
        $pdf->Cell(0, 10, utf8_decode('Repartidor: '.$dataCliente['nombreencargado']), 0, 0, 'C', 0);    
        $pdf->Ln();
        $pdf->Cell(0, 10, utf8_decode('Compañia: '.$dataCliente['nombrecompania']), 0, 0, 'C', 0);    
        $pdf->Ln();
        $pdf->Cell(0, 10, utf8_decode('Contacto:'.$dataCliente['telefonocompania']), 0, 0, 'C', 0);    
        $pdf->Ln();
        //
        $pdf->SetFont('Times', 'B', 11);
        //-----------------------------------------------------.              
        // Se establece un color de relleno para los encabezados.        
        // Se establece la fuente para los encabezados.        
        // Se imprimen las celdas con los encabezados.
        $pdf->Cell(43, 10, utf8_decode('Codigo Producto'), 1, 0, 'C', 1);
        $pdf->Cell(35, 10, utf8_decode('Nombre Producto'), 1, 0, 'C', 1);
        $pdf->Cell(93, 10, utf8_decode('Descripción Producto'), 1, 0, 'C', 1);        
        $pdf->Cell(23, 10, utf8_decode('Precio (US$)'), 1, 0, 'C', 1);        
        $pdf->Cell(22, 10, utf8_decode('Cantidad'), 1, 0, 'C', 1);              
        $pdf->Cell(25, 10, utf8_decode('Total(US$)'), 1, 1, 'C', 1);
        
       
        // Se establece la fuente para los datos de los productos.
        $pdf->SetFont('Times', '', 11);
    foreach ($dataPedido as $row) {
        $pdf->Cell(43, 10, utf8_decode($row['codigoproducto']), 1, 0);
        $pdf->Cell(35, 10, utf8_decode($row['nombreproducto']), 1, 0);
        $pdf->Cell(93, 10, utf8_decode($row['descripcionproducto']), 1, 0);        
        $pdf->Cell(23, 10, $row['precioproducto'], 1, 0);        
        $pdf->Cell(22, 10, $row['cantidad'], 1, 0);
        $pdf->Cell(25, 10, $row['preciototal'], 1, 1);
    }
    } else {
        $pdf->Cell(0, 10, utf8_decode('No hay Pedidos para mostrar'), 1, 1);
    }
   
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay Pedidos para mostrar'), 1, 1);
}
// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>