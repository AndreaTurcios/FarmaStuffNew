<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/public_pages.php");
Public_Page::headerTemplate('Sucursales');
?>

<!-- Aquí comenzamos con el título en un h3 -->
<center><h3 style="background-color: white; color:#2196f3;"> Sucursales </h3></center>   
           
           <div class="container">
           <div class="row">
               <div class=col>
                  <div class="card">
                      <div style="text-align: center;width:300px;">  
                      <img src="http://siraesa.com/wp-content/uploads/2020/05/Edificio-Bambu-3-627x360.jpg" class="img-thumbnail img-fluid">
                  </div>
                      <div class="card-block">
                          <h3 class="card-title text-center">Sucursal Escalón</h3>
                      
                          <p style="text-align: justify;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore. </p>
                          <a href="#" class="card-link btn btn-danger btn-sm btn-block">Leer Más...</a>
                      </div>
                  </div>
              </div>
               <div class=col>
                  <div class="card">
                      <div style="text-align: center;width:300px;">   
                      <img src="https://static.elmundo.sv/wp-content/uploads/2018/01/Alcaldia-de-Santa-Ana.jpg" class="img-thumbnail img-fluid">
                  </div>
                      <div class="card-block">
                          <h3 class="card-title text-center">Sucursal Santa Ana</h3>
                      
                          <p style="text-align: justify;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore. </p>
                          <a href="#" class="card-link btn btn-danger btn-sm btn-block">Leer Más...</a>
                      </div>
                  </div>
              </div>
              <div class=col>
                  <div class="card">
                      <div style="text-align: center;width:300;">   
                      <img src="https://www.alvientooo.com/wp-content/uploads/2018/08/ponte-da-barca-portugal-fin-de-semana-blogguer-viajes-alvientooo-fin-de-semana-en-Ponte-da-Barca-P1030720-627x360.jpeg" class="img-thumbnail img-fluid">
                      </div>
                      <div class="card-block">
                          <h3 class="card-title text-center">Sucursal la Rabida</h3>
                          <p style="text-align: justify;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                          tempor incididunt ut labore. </p>
                          <a href="#" class="card-link btn btn-danger btn-sm btn-block">Leer Más...</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>

<?php
//Se incluye la plantilla del footer para la página web
include("../../app/helpers/public/plantillaFooter.php");
?>