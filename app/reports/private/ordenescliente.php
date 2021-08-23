<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');  
    require('../../models/clientes.php');
    
    // Se instancia el módelo Categorias para procesar los datos.
    $cliente = new Clientes;
    session_start();
    // Se verifica si el parámetro es un valor correcto, de lo contrario se direcciona a la página web de origen.
    if ($cliente->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowCliente = $cliente->readOne()) {
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Órdenes por Cliente');
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataOrden = $cliente->readClienteOrden()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->Cell(142, 10, utf8_decode('Usuario que imprime: '.$_SESSION['usuario']), 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->Cell(176, 10, utf8_decode('Nombre Cliente:  '.$rowCliente['nombrecliente'].' '.$rowCliente['apellidocliente']), 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->Cell(133, 10, utf8_decode('Dirección:  '.$rowCliente['direccioncliente']), 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->Cell(174, 10, utf8_decode('Contacto:  '.$rowCliente['telefonocliente'].' /Correo:  '.$rowCliente['correocliente']), 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->Cell(120, 10, utf8_decode('DUI:  '.$rowCliente['duicliente']), 0, 0, 'C', 0);
                $pdf->Ln();
                $pdf->SetFont('Times', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(56, 10, utf8_decode('Distribuidor'), 1, 0, 'C', 1);
                $pdf->Cell(55, 10, utf8_decode('Encargado del Envío'), 1, 0, 'C', 1);
                $pdf->Cell(28, 10, utf8_decode('Fecha Envío'), 1, 0, 'C', 1);
                $pdf->Cell(28, 10, utf8_decode('Fecha Recibo'), 1, 0, 'C', 1);
                $pdf->Cell(32, 10, utf8_decode('Costo Envío (US$)'), 1, 1, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->SetFont('Times', '', 11);
                // Se recorren los registros ($dataProductos) fila por fila ($rowProducto).
                foreach ($dataOrden as $rows) {
                    // Se imprimen las celdas con los datos de los productos.                    
                    if(isset($rows['nombrecompania'])){
                        $pdf->Cell(56, 10, utf8_decode($rows['nombrecompania']), 1, 0);
                    }
                    if(isset($rows['nombreencargado'])){
                        $pdf->Cell(55, 10, utf8_decode($rows['nombreencargado']), 1, 0);
                    }                    
                    if(isset($rows['fechaenvio'])){
                        $pdf->Cell(28, 10, utf8_decode($rows['fechaenvio']), 1, 0);
                    }
                    if(isset($rows['fechaenvio'])){
                        $pdf->Cell(28, 10, utf8_decode($rows['fecharecibo']), 1, 0);
                    }                    
                    if(isset($rows['costoenvio'])){
                        $pdf->Cell(32, 10, $rows['costoenvio'], 1, 1);
                    }                    
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay Ordenes asociadas con este cliente'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()      
            $pdf->Output();
        } else {
            header('location: ../../../views/private/UsuarioAdminCli.php');
        }
    } else {
        header('location: ../../../views/private/UsuarioAdminCli.php');
    }
} else {
    header('location: ../../../views/private/UsuarioAdminCli.php');
}
?>