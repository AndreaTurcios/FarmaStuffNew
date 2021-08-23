<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/Orden.php');
    
    // Se instancia el módelo Categorias para procesar los datos.
    $orden = new orden;
    session_start();

    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($orden->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowOrden = $orden->readOne()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReports('      Detalle de orden  # '.$rowOrden['idorden']);
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataDetalle = $orden->readClienteDetalle()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                $pdf->Cell(143, 10, utf8_decode('Usuario que imprime: '.$_SESSION['usuario']), 0, 0, 'C', 0);
                $pdf->Ln();   
                // Se establece la fuente para los encabezados.
                $pdf->Cell(148, 10, utf8_decode('Cliente: '.$rowOrden['nombrecliente'].' '.$rowOrden['apellidocliente']), 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->Cell(135, 10, utf8_decode('Dirección:  '.$rowOrden['direccioncliente']), 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->Cell(174, 10, utf8_decode('Contacto:  '.$rowOrden['telefonocliente'].' /Correo:  '.$rowOrden['correocliente']), 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->Cell(125, 10, utf8_decode('DUI:  '.$rowOrden['duicliente']), 0, 0, 'C', 0);
                $pdf->Ln();                
                $pdf->SetFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(39, 10, utf8_decode('Producto'), 1, 0, 'C', 1);
                $pdf->Cell(55, 10, utf8_decode('Distribuidor'), 1, 0, 'C', 1);
                $pdf->Cell(55, 10, utf8_decode('Encargado del Envío'), 1, 0, 'C', 1);
                $pdf->Cell(24, 10, utf8_decode('Fecha Envío'), 1, 0, 'C', 1);
                $pdf->Cell(24, 10, utf8_decode('Fecha Recibo'), 1, 0, 'C', 1);
                $pdf->Cell(36, 10, utf8_decode('Subtotal (USD$)'), 1, 1, 'C', 1);                
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataDetalle as $rows) {
                    // Se imprimen las celdas con los datos de los productos.
                        $pdf->Cell(39, 10, utf8_decode($rows['nombreproducto']), 1, 0);
                        $pdf->Cell(55, 10, utf8_decode($rows['nombrecompania']), 1, 0);
                        $pdf->Cell(55, 10, utf8_decode($rows['nombreencargado']), 1, 0);                 
                        $pdf->Cell(24, 10, utf8_decode($rows['fechaenvio']), 1, 0);
                        $pdf->Cell(24, 10, utf8_decode($rows['fecharecibo']), 1, 0);                        
                        $pdf->Cell(36, 10, $rows['precioporunidad'], 1, 1);                 
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay Ordenes asociadas con este cliente'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()      
            $pdf->Output();
        } else {
            header('location: ../../../views/private/usuarioVentas.php');
        }
    } else {
        header('location: ../../../views/private/usuarioVentas.php');
    }
} else {
    header('location: ../../../views/private/usuarioVentas.php');
}
?>