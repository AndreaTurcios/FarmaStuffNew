<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/public_pages.php");
Public_Page::headerTemplate('Receta con seguro');
?>
 <br>
<br>
<br>
<br>
 <div class="container">
 <div class="card">
 <div class="section container">
                 <form method="post" id="save-form" enctype="multipart/form-data">
                     <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                     <input class="hide" type="number" id="id_recetas" name="id_recetas"/>
                     <div class="row">
                   
                     <div class="file-field input-field col s12 ">
                         <h5 style="color:grey; text-align: center;"> Imagen de la receta </h5>
                         <br>
                         <center><img class="fotos" src="../../resources/img/camara1.png" alt="" width="80" height="60"></center>
                         <div class="file-field input-field col s12 ">
                         <div class="btn waves-effect tooltipped" data-tooltip="Seleccione una imagen de al menos 500x500">
                              <span><i class="material-icons">image</i></span>
                             <input id="archivo_receta" type="file" name="archivo_receta" accept=".gif, .jpg, .png"/>
                     </div>
                     <div class="file-path-wrapper">
                         <input type="text" class="file-path validate" placeholder="Formatos aceptados: gif, jpg y png"/>
                     </div>
                 </div>   
                   <div class="file-field input-field col s12 ">
                 <h5 style="color:grey; text-align: center;"> Imagen del seguro (adelante) </h5>
                         <br>
                         <center><img class="fotos" src="../../resources/img/camara1.png" alt="" width="80" height="60"></center>
                         <div class="btn waves-effect tooltipped" data-tooltip="Seleccione una imagen de al menos 500x500">
                              <span><i class="material-icons">image</i></span>
                             <input id="archivo_carnet" type="file" name="archivo_carnet" accept=".gif, .jpg, .png"/>
                     </div>
                     <div class="file-path-wrapper">
                         <input type="text" class="file-path validate" placeholder="Formatos aceptados: gif, jpg y png"/>
                     </div>
                 </div>  
                 <div class="file-field input-field col s12 ">
                 <h5 style="color:grey; text-align: center;"> Imagen del seguro (por detras) </h5>
                         <br>
                         <center><img class="fotos" src="../../resources/img/camara1.png" alt="" width="80" height="60"></center>
                         <div class="file-field input-field col s12 ">
                         <div class="btn waves-effect tooltipped" data-tooltip="Seleccione una imagen de al menos 500x500">
                              <span><i class="material-icons">image</i></span>
                             <input id="archivo_carnets" type="file" name="archivo_carnets" accept=".gif, .jpg, .png"/>
                     </div>
                     <div class="file-path-wrapper">
                         <input type="text" class="file-path validate" placeholder="Formatos aceptados: gif, jpg y png"/>
                     </div>
                 </div>                                               
                          </div> 
                          </div>
                          </div>
                          <div class="row center-align">
                          <button type="submit"  class="btn waves-effect blue tooltipped">Ingresar</button>
                          </div>
                         </form>
                     </div> 
                  </div> 
                  </div>
                  <br>
<br>
<br>
<br>
<?php
//Se incluye la plantilla del footer para la página web
include("../../app/helpers/public/plantillaFooter.php");
?>