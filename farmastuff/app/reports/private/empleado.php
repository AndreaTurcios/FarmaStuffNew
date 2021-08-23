<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../helpers/report.php');
    require('../../models/empleados.php');
    // Se instancia el modelo en este caso productos para procesar los datos.
    $empleados = new Empleados;
    session_start();
    if ($empleados->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowEmpleado = $empleados->readOne()) {//leer un solo empleado
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReports('Reporte de datos de empleado');
            // Se verifica si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
            if ($empleadoss = $empleados->readReport()) {// leer todos los registros
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(225);
                // Se establece la fuente para los encabezados.
                $pdf->Cell(65, 10, utf8_decode('Usuario que imprime: '.$_SESSION['usuario']));
                $pdf->Ln();  
                $pdf->SetFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(40, 10, utf8_decode('Nombres'), 1, 0, 'C', 1);
                // Se establece la fuente para los datos de los productos.
                $pdf->Cell(40, 10, utf8_decode('Apellidos'), 1, 0, 'C', 1);
                $pdf->Cell(28, 10, utf8_decode('Usuario'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Tipo empleado'), 1, 0, 'C', 1);
                $pdf->Cell(50, 10, utf8_decode('Correo empleado'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Teléfono'), 1, 0, 'C', 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Ln();
                // Se recorren los registros
                foreach ($empleadoss as $rows) {
                    // Se imprimen las celdas con los datos de los productos.                    
                    if(isset($rows['nombreempleado'])){
                        $pdf->Cell(40, 10, utf8_decode($rows['nombreempleado']), 1, 0);
                    }
                    if(isset($rows['apellidoempleado'])){
                        $pdf->Cell(40, 10, utf8_decode($rows['apellidoempleado']), 1, 0);
                    }                    
                    if(isset($rows['usuario'])){
                        $pdf->Cell(28, 10, utf8_decode($rows['usuario']), 1, 0);
                    }
                    if(isset($rows['tipoempleado'])){
                        $pdf->Cell(40, 10, utf8_decode($rows['tipoempleado']), 1, 0);
                    }                    
                    if(isset($rows['correoempleado'])){
                        $pdf->Cell(50, 10, $rows['correoempleado'], 1, 0);
                    }   
                    if(isset($rows['telefonoempleado'])){
                        $pdf->Cell(40, 10, $rows['telefonoempleado'], 1, 1);
                    }                    
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay empleados asociados'), 1, 1);
            }
            
            // Se envía el documento al navegador y se llama al método Footer()  
            $pdf->Output();
        } else {//fin de rowOrden
            header('location: ../../../views/private/UsuarioAdminUsu.php');
        }
        
    } else {
        header('location: ../../../views/private/UsuarioAdminUsu.php');
    }
} else {
    header('location: ../../../views/private/UsuarioAdminUsu.php');
}
?>