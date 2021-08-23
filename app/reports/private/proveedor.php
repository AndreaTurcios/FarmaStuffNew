<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/proveedor.php');
    // Se instancia el modelo en este caso productos para procesar los datos.
    $proveedores = new Proveedor;
    session_start();

    if ($proveedores->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowProveedor = $proveedores->readOne()) {//leer un solo proveedor este esta malo 
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReports('Productos por proveedor');
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataDetalle = $proveedores->readReport()) {// leer todos los regisotrs este esta bien 
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->Cell(49, 10, utf8_decode('Usuario que imprime: '.$_SESSION['usuario']), 0, 0, 'C', 0);
                $pdf->Ln();  
                $pdf->SetFont('Arial', 'B', 11);
                $pdf->Cell(58, 10, utf8_decode('Proveedor:  '.$rowProveedor['nombrecompania']));
                $pdf->Ln();   
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(55, 10, utf8_decode('Encargado'), 1, 0, 'C', 1);
                $pdf->Cell(60, 10, utf8_decode('Productos'), 1, 0, 'C', 1);
                $pdf->Cell(55, 10, utf8_decode('Costo p/unidad'), 1, 0, 'C', 1);
                $pdf->Cell(32, 10, utf8_decode('Existencias'), 1, 0, 'C', 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Ln();   
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataDetalle as $rows) {
                    // Se imprimen las celdas con los datos de los proveedores              
                    if(isset($rows['representante'])){
                        $pdf->Cell(55, 10, utf8_decode($rows['representante']), 1, 0);
                    }                    
                    if(isset($rows['nombreproducto'])){
                        $pdf->Cell(60, 10, utf8_decode($rows['nombreproducto']), 1, 0);
                    }
                    if(isset($rows['precioporunidad'])){
                        $pdf->Cell(55, 10, utf8_decode($rows['precioporunidad']), 1, 0);
                    }                    
                    if(isset($rows['existencias'])){
                        $pdf->Cell(32, 10, $rows['existencias'], 1, 1);
                    }                    
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos asociados con este proveedor'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()  
            $pdf->Output();
        } else {//fin de rowOrden
            header('location: ../../../views/private/proveedor.php');
        }
    } else {
        header('location: ../../../views/private/proveedor.php');
    }
} else {
    header('location: ../../../views/private/proveedor.php');
}
?>