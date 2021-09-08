<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/private/dashboardPage.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Home');
?>                                 

<!--Contenedor para mostrar una tabla con datos-->
<div class="container center-align">
<img  width="250" src="../../resources/img/Originals/logoconpng.png">
</div>
<!-- Se muestran las gráficas de acuerdo con algunos datos disponibles en la base de datos -->
<div class="row">
    
    
    <div class="col s12 m6">
        <!-- Se muestra una gráfica de barra con la cantidad de productos por categoría -->
        <canvas id="chart1"></canvas>
        <!-- Se muestra una gráfica de pastel con el porcentaje de clientes por estado -->
        <canvas id="chart2"></canvas>
    </div>

    <div class="col s12 m6">
        <!-- Se muestra una gráfica de pastel con el porcentaje de valoraciones por producto -->
        <canvas id="chart4"></canvas>
    </div>

    <div class="col s12 m6">
        <!-- Se muestra una gráfica de pastel con el porcentaje de empleados con estado true y false -->
        <canvas id="chart5"></canvas>
    </div>
    <div class="container center-align">
        <!-- Se muestra una gráfica de barras con la cantidad de existencias por producto -->
        <canvas id="chart3"></canvas>
    </div>

    
</div>

<!-- Importación del archivo para generar gráficas en tiempo real. Para más información https://www.chartjs.org/ -->
    <script type="text/javascript" src="../../resources/js/chart.js"></script>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
Dashboard_Page::footerTemplate('index.js');
?>