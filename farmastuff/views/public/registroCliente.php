<?php
include('../../app/helpers/public/plantillaHeaderLogin.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Registro');
?>  
<link href="../../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
<div class="container">
    <div class="row">
        <div class="card col s12 m8">
        <form method="post" id="save-form">
        <div class="g-recaptcha" data-sitekey="6LfpUGccAAAAAFHZ7KrEokJ9dUDy5bR_q_LFY7MU"></div>
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"/>
        <hr>Registro cliente</hr>
                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                    <input class="hide" type="number" id="id_cliente" name="id_cliente"/>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">person</i>
                            <input id="nombres_clientes" type="text" name="nombres_clientes"  pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required/>
                            <label for="nombres_clientes">Nombre Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">person</i>
                            <input id="apellidos_clientes" type="text" name="apellidos_clientes" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" class="validate" required/>
                            <label for="apellidos_clientes">Apellido Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">email</i>
                            <input id="correo_clientes" type="email" name="correo_clientes" class="validate" required/>
                            <label for="correo_clientes">Correo Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">phone</i>
                            <input id="telefono_clientes" type="tel" name="telefono_clientes" class="validate" placeholder="0000-0000" pattern="[2,6,7]{1}[0-9]{3}[-][0-9]{4}" required/>
                            <label for="telefono_clientes">Teléfono Cliente</label>
                        </div>                       
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">badge</i>
                            <input id="dui_clientes" type="text" name="dui_clientes" class="validate" placeholder="00000000-0" required/>
                            <label for="dui_clientes">Dui Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>                            
                            <input id="direccion_clientes" type="text" name="direccion_clientes" class="validate" required/>
                            <label for="direccion_clientes">Direccion</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>                            
                            <input id="usuario" type="text" name="usuario" class="validate" required/>
                            <label for="usuario">Usuario</label>
                        </div>

                        <div class="input-field col s12 m6">
                    <i class="material-icons prefix">security</i>
                    <input id="clave" type="password" name="clave" class="validate" required/>
                    <label for="clave">Clave</label>
                </div>                           
                    </div>
                    <label class="center-align col s12">
                <input type="checkbox" id="condicion" name="condicion" required/>
                <span>Acepto <a href="#terminos" class="modal-trigger">términos y condiciones</a></span>
            </label>
                    <div class="row center-align">
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                    </div>           
                </form>
       </div>
    </div>
</div>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=6LeBqFccAAAAAKKKyrQri1N3nktSRu1YR8TC2iNs"></script>
<?php
//Se incluye la plantilla del footer para la página web
Dashboard_Page::footerTemplate('clienteRegistro.js');
?>