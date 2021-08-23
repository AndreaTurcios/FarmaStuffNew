<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/public_pages.php");
Public_Page::headerTemplate('Conocenos');
?>

<br><br>

 <h3 style="background-color: white; color:#2196f3;"> ¿Quiénes Somos? </h3>  
           
              <div class="container">
            <div class="row">
                <div class=col>
                    <div class="card">
                       
                        <div class="card-block">
                            <h3 class="card-title text-center">Valores</h3>
                        
                            <p style="text-align: justify;"> Trabajo en equipo: Trabajar con un objetivo común, respetando y valorando las diferentes opiniones, fortaleciendo las relaciones interpersonales y priorizando el éxito del equipo en beneficio del resultado por sobre el éxito individual.
 
                            Equidad: En la utilización de los recursos y servicios de la institución sin distinción de edad, género, grupo social, ideología y credo, estado de salud o enfermedad.
                            </p>
                            <a href="#" class="card-link btn btn-danger btn-sm btn-block">Leer Más...</a>
                        </div>
                    </div>
                </div>

            <div class="container">
            <div class="row">
                <div class=col>
                    <div class="card">
                       
                        <div class="card-block">
                            <h3 class="card-title text-center">Misión</h3>
                        
                            <p style="text-align: justify;"> Satisfacer de manera eficaz y eficiente las necesidades de cuidado de salud de la comunidad.
                            Brindar a toda la comunidad la mejor atención medica basada en la evidencia científica y contenido ético, acompañando al paciente y su familia.
                            Garantizar la revisión y actualización de los conocimientos, procesos, tecnologías y estructuras, gestionando nuestros recursos con racionalidad económica de forma transparente y honesta.</p>
                            <a href="#" class="card-link btn btn-danger btn-sm btn-block">Leer Más...</a>
                        </div>
                    </div>
                </div>
                <div class=col>
                    <div class="card">
                         
                        <div class="card-block">
                            <h3 class="card-title text-center">Visión</h3>
                            <p style="text-align: justify;"> Crear y sostener un sistema integral de salud privada, que ofrezca un espacio de crecimiento y desarrollo profesional enfocado en la excelencia y calidez en la asistencia al paciente y su familia.
                            Ser una Organización Modelo en Gestión y Asistencia en el cuidado de la Salud.</p>
                            <a href="#" class="card-link btn btn-danger btn-sm btn-block">Leer Más...</a>
                        </div>
                    </div>
                </div>
                        
        </div>
    </div>
</div>
</div>

<?php
//Se incluye la plantilla del footer para la página web
include("../../app/helpers/public/plantillaFooter.php");
?>