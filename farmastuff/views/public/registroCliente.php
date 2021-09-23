<?php
include('../../app/helpers/public/plantillaHeaderLogin.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Registro');
?>  
<link href="../../resources/css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />
<!--<script src="https://www.google.com/recaptcha/api.js"></script>-->
<div class="container">
    <div class="row">
        <div class="card col s12 m8">
        <form method="post" id="save-form">
        <hr>Registro cliente</hr>
                    <!-- Campo oculto para asignar el id del registro al momento de modificar -->
                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"/>

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
                            <input id="correo_clientes" type="email" name="correo_clientes" class="validate"  oncopy="return false" oncut="return false" onpaste="return false" required autocomplete="off"/>
                            <label for="correo_clientes">Correo Cliente</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">phone</i>
                            <input id="telefono_clientes" type="tel" name="telefono_clientes" class="validate" placeholder="0000-0000" pattern="[2,6,7]{1}[0-9]{3}[-][0-9]{4}" oncopy="return false" oncut="return false" onpaste="return false" required autocomplete="off"/>
                            <label for="telefono_clientes">Teléfono Cliente</label>
                        </div>                       
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">badge</i>
                            <input id="dui_clientes" type="text" name="dui_clientes" class="validate" placeholder="00000000-0" oncopy="return false" oncut="return false" onpaste="return false" required autocomplete="off"/>
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
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">security</i>
                    <input id="clavef" type="password" name="clavef" class="validate" required/>
                    <label for="clavef">Confirmar Contraseña</label>
                </div>                           
                    </div>
                    <label class="center-align col s12">
                        <input type="checkbox" id="condicion" name="condicion" required/>
                            <span>Acepto <a href="#terminos" class="modal-trigger">términos y condiciones</a></span>
                    </label>
                    <div class="row center-align">
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
                    </div>         
                    
                    <div id="terminos" class="modal">
                    <div class="modal-content">
                        <h4 class="center-align">Términos y condiciones</h4>
                        <p>FarmaStuff, , con el fin de aportar valor agregado en la sociedad Salvadoreña, con el firme compromiso de garantizar accesibilidad, eficiencia, disponibilidad, calidad, seguridad y cobertura en la demanda de medicamentos y productos cosméticos del país, siendo un medio necesario para que prevalezca la salud dentro de la población y cumpliendo con el uso racional de los mismos, pone a disposición un canal digital para que el cliente pueda tener mayor facilidad para solicitar y surtir sus medicamentos y/o productos de conveniencia, todo esto cumpliendo los reglamentos y normas establecidas para la responsable dispensación de medicamentos. Farmacia San Nicolás realizará la verificación de las recetas elaboradas por los profesionales autorizados y se reserva el derecho de poder negar despachos de medicinas que no estén acorde a lo autorizado por la DNM y a realizar devoluciones a nuestros clientes cuando sus recetas no coincidan con lo que dicte la ley vigente. El cliente tendrá acceso a la validación y verificación de las mismas a través de nuestro chat en línea antes de ejecutar la solicitud de su pedido, la receta será verificada por un dependiente de farmacia capacitado para la correcta orientación del paciente en la concentración, forma farmacéutica y cantidad especificada en su receta, sin modificar el principio activo prescrito.</p>
                    </div>
                    <div class="divider"></div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-action modal-close btn waves-effect"><i class="material-icons">done</i></a>
                        </div>
                    </div>
                </form>
       </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render=6LfpUGccAAAAAFHZ7KrEokJ9dUDy5bR_q_LFY7MU"></script>
<?php
//Se incluye la plantilla del footer para la página web
Dashboard_Page::footerTemplate('clienteRegistro.js');
?>