<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/edit_usuario.php');
    // Se instancia el modelo en este caso productos para procesar los datos.
    $edit = new edit;
    session_start();
    if ($edit->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowEdit = $edit->readOne()) {//leer un solo empleado
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReports('Reporte de valoraciones por cliente');
            $pdf->Cell(58, 10, utf8_decode('Usuario que imprime: '.$_SESSION['usuario']));
            $pdf->Ln(); 
            $pdf->SetFont('Arial', 'B', 11);  
            $pdf->Cell(58, 10, utf8_decode('Usuario cliente: '.$rowEdit['usuariocliente']));
            $pdf->Ln();  
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($rowEdit = $edit->readReport()) {// leer todos los registros
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                
                // Se establece la fuente para los datos de los productos.
                $pdf->Cell(120, 10, utf8_decode('Comentario'), 1, 0, 'C', 1);
                $pdf->Cell(30, 10, utf8_decode('Valoración'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Estado valoración'), 1, 0, 'C', 1);
                $pdf->Cell(50, 10, utf8_decode('Producto a evaluar'), 1, 0, 'C', 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Ln();
                // Se recorren los registros
                foreach ($rowEdit as $rows) {
                   
                    if(isset($rows['comentario'])){
                        $pdf->Cell(120, 10, utf8_decode($rows['comentario']), 1, 0);
                    }                    
                    if(isset($rows['estrellas'])){
                        $pdf->Cell(30, 10, utf8_decode($rows['estrellas']), 1, 0);
                    }
                    if(isset($rows['estadovaloracion'])){
                        $pdf->Cell(40, 10, utf8_decode($rows['estadovaloracion']), 1, 0);
                    }                    
                    if(isset($rows['nombreproducto'])){
                        $pdf->Cell(50, 10, $rows['nombreproducto'], 1, 0);
                    }          
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay productos asociados'), 1, 1);
            }
            
            // Se envía el documento al navegador y se llama al método Footer()  
            $pdf->Output();
        } else {//fin de rowOrden
            header('location: ../../../views/private/empleadoMantenimiento.php');
        }
        
    } else {
        header('location: ../../../views/private/empleadoMantenimiento.php');
    }
} else {
    header('location: ../../../views/private/empleadoMantenimiento.php');
}
?>