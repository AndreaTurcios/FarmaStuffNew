<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/productos.php');
    // Se instancia el modelo en este caso productos para procesar los datos.
    $productos = new Productos;
    session_start();
    if ($productos->setId($_GET['id'])) {  
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowProductos = $productos->readOne()) {//leer un solo proveedor este esta malo 
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReports('Datos de producto');
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataDetalle = $productos->readReport()) {// leer todos los regisotrs este esta bien 
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                $pdf->Cell(47, 10, utf8_decode('Usuario que imprime: '.$_SESSION['usuario']), 0, 0, 'C', 0);
                $pdf->Ln(); 
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Arial', 'B', 11);
                $pdf->Cell(55, 10, utf8_decode('Producto:  '.$rowProductos['nombreproducto']), 0, 0, 'C', 0);
                $pdf->Ln();   
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(70, 10, utf8_decode('Distribuidores'), 1, 0, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->Cell(55, 10, utf8_decode('Producto'), 1, 0, 'C', 1);
                $pdf->Cell(100, 10, utf8_decode('Descripción'), 1, 0, 'C', 1);
                $pdf->Cell(25, 10, utf8_decode('Existencias'), 1, 0, 'C', 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Ln();   
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataDetalle as $rows) {
                    // Se imprimen las celdas con los datos de los productos.    
                    if(isset($rows['nombrecompania'])){
                        $pdf->Cell(70, 10, utf8_decode($rows['nombrecompania']), 1, 0);
                    }      
                    if(isset($rows['nombreproducto'])){
                        $pdf->Cell(55, 10, utf8_decode($rows['nombreproducto']), 1, 0);
                    }      
                    if(isset($rows['descripcionproducto'])){
                        $pdf->Cell(100, 10, utf8_decode($rows['descripcionproducto']), 1, 0);
                    }    
                    if(isset($rows['existencias'])){
                        $pdf->Cell(25, 10, utf8_decode($rows['existencias']), 1, 0);
                    }  
                    $pdf->Ln();            
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos asociados con este proveedor'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()  
            $pdf->Output();
        } else {//fin de rowOrden
            header('location: ../../../views/private/UsuarioBodeguero.php');
        }
    } else {
        header('location: ../../../views/private/UsuarioBodeguero.php');
    }
} else {
    header('location: ../../../views/private/UsuarioBodeguero.php');
}
?>