<?php
//Se incluye la plantilla del encabezado para la página web
include("../../app/helpers/public/plantillaHeader.php");
?>
<div class="container">
    <div class="row">
    <div class="col s12 m7">
        <div class="card">
            <div class="card-image">
            <img src="https://locatelcolombia.vteximg.com.br/arquivos/ids/226599-1000-1000/7509546074405_1_CEPILLO-DENTAL-COLGATE-360-SENSITIVE-PRO-ALIVIO-2X1.jpg?v=637269234472100000" class="responsive-img">
            </div>
            <div class="card-content">
            <span class="card-title">Cepillo de Dientes</span>
            <div class="divider"></div>
            <span>$ 2.99</span>
            <p>I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
            <a href="#">This is a link</a>
            </div>
        </div>
        </div>

    <div class="col s12 m12">
        <h2 class="center">Comentarios</h2>
        <div class="container"> 
            <div class="container">
            <div class="row">
                  <div class="card red lighten-3">
                    <div class="card-content white-text">
                      <span class="card-title">Escriba su comentario</span>
                      <form action="">
                      <div class="input-field">
                        <textarea id="textarea2" class="materialize-textarea" data-length="120"></textarea>
                        <label for="textarea2">Escriba aquí...</label>
                      </div>          
                        </form>
                    </div>
                    <div class="card-action">
                        <center>
                        <button type="reset" style="background-color: #e57373;" class="btn btn-primary btn-block valign-wrapper"><i class="material-icons right">send</i>Enviar</button></center>
                    </center>
                    </div>
                  </div>
              </div>
            </div>   
         </div>        
            <div class="col s10 m12">
                <h5 class="header">Andrea Turcios</h5>
                <div class="card">
                  <div class="card-image m4">
                      <div style="text-align: right;width:150px">
                    <img src="../../resources/img/andreafoto.png" class="responsive-img">
                      </div>
                  </div>
                  <div class="card-stacked">
                    <div class="card-content">
                      <p>Excelente calidad en productos farmaceuticos, los felicito.</p>
                    </div>
                    <div class="card-action">
                    <a class="waves-effect waves-teal btn-flat">Responder</a>
                    </div>
                  </div>
                </div>
              </div>                         
            <div class="col s10 m10">
                <h5 class="header">Adalberto Paredes</h5>
                <div class="card">
                  <div class="card-image m4">
                    <div style="text-align: right;width:130px">
                        <img src="../../resources/img/adalbertofoto.jpeg" class="responsive-img">
                    </div>
                  </div>
                  <div class="card-stacked">
                    <div class="card-content">
                      <p>Me parece que FarmaStuff es la mejor página para comprar productos farmaceuticos de todo tipo, excelente servicio.</p>
                    </div>
                    <div class="card-action">
                    <a class="waves-effect waves-teal btn-flat">Responder</a>
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