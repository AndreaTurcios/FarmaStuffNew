<?php
//Se incluye la plantilla del encabezado para la página web 
include("../../app/helpers/public/public_pages.php");
Public_Page::headerTemplate('Bienvenido');
?>
<!--Aquí comenzamos abriendo la sección -->                            
            <main>        
    <div class="container">
            <!-- Contenedor para mostrar el catálogo de tipos de producto -->
                <div class="container">
                    <!-- Título del contenido principal -->
                    <h4 class="center indigo-text" id="title">Nuestro catálogo</h4>
                    <!-- Fila para mostrar las categorías disponibles -->
                    <div class="row" id="tipo"></div>
                </div>
      <!-- Contenedor para mostrar los producto de la categoría seleccionada previamente -->
      <div class="container">
        <!-- Título del contenido principal -->
        <h4 class="center indigo-text" id="title"></h4>
        <!-- Fila para mostrar los productos disponibles por categoría -->
        <div class="row" id="productos"></div>
          </div>          

        <hr>
            
            <div class="container">
            <div class="row">
                <div class="col-lg-9">
                  <div class="card">
                    <div class="card-content">
                      <span class="card-title">Contáctanos</span>
                      <span><i class="fas fa-user-alt"></i>Andrea Turcios</span><br/>
                      <span><i class="fas fa-mobile"></i> 7127-6891</span> <br/>
                      <span><i class="fas fa-phone-alt"></i> 2216-5389</span> <br/>
                      <span><i class="fas fa-envelope-square"></i> farmastuff442@gmail.com</span> <br/>
                    </div>
                    <div class="card-action">
                    <form action="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                        </div>
                            <div class="input-field col s6">
                               <input id="first_name" type="text" class="validate">
                               <label for="first_name">Nombre</label>
                        </div>
                              </div>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        </div>
                        <div class="input-field col s6">
                          <input id="email" type="text" class="validate">
                          <label for="email">Correo</label>
                        </div>
                            </div>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                        </div>
                          <textarea name="" cols="30" rows="10" placeholder="Deja tu opinión sobre FarmaStuff en este espacio o alguna queja..." class="form-control"></textarea>
                        </div>
                        <br>
                          <center><button type="reset" style="background-color: #e57373;" class="btn btn-primary btn-block valign-wrapper">Enviar</button></center>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            
            <div class="col-lg-3 align-self-center">
                <div class="fixed-action-btn">
                    <a href="carritoCompras.php" class="btn-floating btn-large red lighten-1"><i class="material-icons" style="font-style: unset;">add_shopping_cart</i></a>
                    
                </div>
            </div>
            </div>
            </div>
        </section>
      </div>
      </main>

<?php
//Se incluye la plantilla del footer para la página web
Public_Page::footerTemplate('index.js');
?>