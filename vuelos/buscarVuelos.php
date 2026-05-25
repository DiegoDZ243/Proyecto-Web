<?php
    session_start(); 
    require('api/classInfoVuelos.php'); 
    $vuelos=new vuelos(); 
    $listaDestinos=$vuelos->getDestinos(); 
    $listaVuelosBaratos=$vuelos->getVuelosBaratos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroPHP - Buscar Vuelos</title>
    <link rel="stylesheet" href="css/buscarVuelos.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/barraSuperior.css">
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <section class="barra-superior">
        <div class="contenedor-barra">
            <div class="contendor-logo">
                <h5>AeroPHP</h5>
                <img src="img/icn-logo.png" alt="logo aeropuerto">
            </div>
            <div class="contendor-enlaces">
                <?php if(isset($_SESSION["usuario"])):?>
                    <h3> ¡Bienvenido, <?= $_SESSION["usuario"] ?>!</h3>
                    <a href="mis_boletos.php">Mis boletos</a>
                <?php endif ?>
                <a href="../logout.php" id="login-boton" style="color: red;">
                    <img src="img/icn-usuario.png" alt="iconoUsuario">
                    <?php if(isset($_SESSION["usuario"])){ ?>
                        <h5>Cerrar sesión</h5>

                    <?php } else { ?>
                        <h5>Iniciar sesión</h5>
                    <?php } ?>
                </a>
            </div>
        </div>
    </section>
    <!-- Login -->
    <div class="fondo-overlay" id="overlay" hidden>
        <form id="formulario-login" method="post" action="validar.php">
            <input name="router" value="buscarVuelos.php" hidden>
            <div class="encabezado-login">
                <div class="contenedor-titulo">
                    <h1>Inicia sesión</h1>
                    <button id="btnSalirLogin"> X </button>
                </div>
            </div>
            <div class="cuerpo-login">
                <div class="texto-login">
                    <p>Inicia sesión para ver y comprar boletos</p>
                    <img src="img/icn-login.png">
                </div>
                <div class="error-login" <?php if(!isset($_GET["err"])): ?> hidden <?php endif ?>>
                    <p>Usuario y/o contraseña incorrectas</p>
                </div>
            </div>
            <div class="fondo-login">
                <div class="contenedor-usuario-login">
                    <input type="email" name="correo" placeholder="Email" required>
                </div>
                <div class="contenedor-pass-login">
                    <input type="password" name="pass" placeholder="Contraseña" required>
                    <img >
                </div>
                <div class="contenedor-boton-login">
                    <button type="submit">Iniciar sesión</button>
                </div>
            </div>
            <div class="pie-login">
                <p>¿No tienes cuenta? <a>Regístrate aquí</a></p>
            </div>
        </form>
    </div>
    <!-- Registro -->
    <div class="fondo-overlay" id="overlay-registro" hidden>
        <form id="formulario-registro" method="post" action="registrar.php">
            <input name="router" value="buscarVuelos.php" hidden>

            <div class="encabezado-login">
                <div class="contenedor-titulo">
                    <h1>Crear cuenta</h1>
                    <button type="button" id="btnSalirRegistro">X</button>
                </div>
            </div>

            <div class="cuerpo-login">
                <div class="texto-login">
                    <p>Regístrate para comprar boletos y consultar tus vuelos</p>
                    <img src="img/icn-login.png" alt="icono registro">
                </div>

                <div class="error-login" id="error-registro" hidden>
                    <p id="texto-error-registro">Todos los campos son obligatorios</p>
                </div>
            </div>

            <div class="fondo-login">
                <div class="contenedor-usuario-login">
                    <label>Nombre: </label>
                    <input type="text" name="nombre" placeholder="Nombre" required>
                </div>

                <div class="contenedor-usuario-login">
                    <label>Apellido Paterno: </label>
                    <input type="text" name="apellidoPat" placeholder="Apellido paterno" required>
                </div>

                <div class="contenedor-usuario-login">
                    <label>Apellido Materno: </label>
                    <input type="text" name="apellidoMat" placeholder="Apellido materno" required>
                </div>

                <div class="contenedor-usuario-login">
                    <label>Fecha de nacimiento: </label>
                    <input type="date" name="fecha_nac" required>
                </div>

                <div class="contenedor-usuario-login">
                    <label>Email: </label>
                    <input type="email" name="correo" placeholder="Email" required>
                </div>

                <div class="contenedor-pass-login">
                    <label>Contraseña: </label>
                    <input type="password" name="pass" placeholder="Contraseña" required>
                </div>

                <div class="contenedor-pass-login">
                    <label>Confirma contraseña: </label>
                    <input type="password" name="confirmarPass" placeholder="Confirmar contraseña" required>
                </div>

                <div class="contenedor-boton-login">
                    <button type="submit">Registrarme</button>
                </div>
            </div>

            <div class="pie-login">
                <p>¿Ya tienes cuenta? <a id="abrir-login">Inicia sesión aquí</a></p>
            </div>
        </form>
    </div>

    <main class="fondo-buscador">
        <form class="contenedor-buscador" method="post" action="seleccionarVuelo.php" id="formulario-busqueda">
            <!-- Mensaje de error -->
            <div id="error-message" class="error-message" '; hidden>
                <p id="error-text"></p>
            </div>

            <div class="parte-superior">
                <div class="contendor-ubicaciones">
                    <div class="contenedor-lugar">
                        <img src="img/icn-destino.png" alt="ubicacion">
                        <div class="contenedor-select-ubicacion">
                            <label>Origen</label>
                            <select name="origen" id="select-origen">
                                <option value="" selected disabled>Selecciona un origen</option>
                                <?php foreach($listaDestinos as $d):?>
                                    <option value="<?= $d["id_destino"] ?>" id="<?= $d["id_destino"] ?>-org"><?= $d["ciudad"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="contenedor-lugar">
                        <img src="img/icn-destino.png" alt="ubicacion">
                        <div class="contenedor-select-ubicacion">
                            <label>Destino</label>
                            <select name="destino" id="select-destino">
                                <option value="" selected disabled>Selecciona un destino</option>
                                <?php foreach($listaDestinos as $d):?>
                                    <option value="<?= $d["id_destino"] ?>" id="<?= $d["id_destino"] ?>-dest"> <?= $d["ciudad"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="contenedor-salida">
                    <div class="contenedor-fecha">
                        <img src="img/icn-salida.png" alt="salida">
                        <div class="contenedor-input-fecha">
                            <label>Salida</label>
                            <input type="date" name="fecha_salida" min="2026-01-01" max="<?= date('Y-m-d', strtotime('+3 year')) ?>">
                        </div>
                    </div>
                </div>
                <div class="contenedor-pasajeros">
                    <div class="contenedor-clientes">
                        <img src="img/icn-pasajero.png" alt="salida">
                        <div class="contenedor-input-pasajero">
                            <label>Pasajeros</label>
                            <input type="number" name="pasajeros" id="pasajeros" step="1" placeholder="¿Cuántos viajan?">
                        </div>
                    </div>
                </div>
            </div>
            <div class="parte-inferior">
                <button id="btn-buscar-vuelo">
                    <div class="interior-boton-buscar">
                        <p>Buscar vuelos</p>
                        <img src="img/icn-avion.png" alt="avion">
                    </div>
                </button>
            </div>
        </form>    
    </main>

   
        <!-- Dashborad de los vuelos con el precio más bajo -->
        <section class="dashboard-vuelos-baratos">
            <h1>Vuelos baratos</h1>

            <div class="contenedor-tarjetas-vuelos" >
                <?php $i=0; foreach($listaVuelosBaratos as $v):?>
                <form method="post" action="seleccionarAsientos.php" class="tarjeta-vuelo" style="background-image: url('<?= htmlspecialchars($v["imagen"]) ?>');">
                    <div class="contenedor-origen-destino">
                        <h4 id="origen-<?= $i ?>"><?= $v["origen"] ?></h4>
                        <h4> a </h4>
                        <h4 id="destino-<?= $i ?>"><?= $v["destino"] ?></h4>
                    </div>

                    <div class="contenedor-mas-info">
                        <div class="contendor-precio">
                            <h5>Desde</h5>
                            <h3 id="precio"><?= $v["precio"] ?><p>MXN</p></h3>
                            <h5>Por persona</h5>
                        </div>
                        <div class="contendor-fecha">
                            <h5>Fecha</h5>
                            <h3 id="fecha"><?= $v["fecha"] ?></h3>
                        </div>
                        <div class="contendor-hora">
                            <h5>Salida</h5>
                            <h3 id="salida"><?= $v["hora"] ?></h3>
                        </div>
                    </div>
                    <input name="vuelo" type="number" value="<?= $v["id_vuelo"] ?>" hidden>
                    <input name="pasajeros" type="number" value="1" hidden>
                    <button id="btn-<?= $v["id_vuelo"] ?>" hidden></button>
                </form>
                <?php endforeach; ?>
            </div>  
        </section>
        
        <script>
            const botonLogin=document.getElementById("login-boton"); 
            const botonSalirLogin=document.getElementById("btnSalirLogin");
            const fondoOverlay=document.getElementById("overlay"); 
            const formularioLogin=document.getElementById("formulario-login"); 

            <?php if(isset($_GET["err"]) || isset($_GET["registro"])): ?>
                fondoOverlay.hidden=false; 
            <?php endif ?>
            botonLogin.addEventListener('click',(e)=>{
                <?php if(!isset($_SESSION["usuario"])):?>
                    e.preventDefault(); 
                    if(formularioLogin.classList.toggle("sobrepuesta")){
                        fondoOverlay.hidden=true;
                    }else{
                        fondoOverlay.hidden=false;
                    }
                <?php endif ?>
            }); 

            botonSalirLogin.addEventListener('click',(e)=>{
                <?php if(!isset($_SESSION["usuario"])):?>
                    e.preventDefault(); 
                    if(formularioLogin.classList.toggle("sobrepuesta")){
                        fondoOverlay.hidden=true;
                        <?php if(isset($_GET["err"])): ?>
                            window.history.replaceState({}, document.title, window.location.pathname);
                        <?php endif; ?>
                    }else{
                        fondoOverlay.hidden=false;
                    }    
                <?php endif ?>
            }); 


        </script>
        <script>
            const listaCiudadOrigen= <?php echo json_encode($listaDestinos) ?>;
            const listaCiudadDestino= <?php echo json_encode($listaDestinos)?>; 
            const selectOrigen=document.getElementById("select-origen"); 
            const selectDestino=document.getElementById("select-destino"); 
            const btnBuscar = document.getElementById("btn-buscar-vuelo");
            const formulario = document.getElementById("formulario-busqueda");
            const errorMessage = document.getElementById("error-message");
            const errorText = document.getElementById("error-text");

            // Función de validación
            function validarFormulario() {
                const origen = selectOrigen.value;
                const destino = selectDestino.value;
                const fecha = document.querySelector('input[name="fecha_salida"]').value;
                const pasajeros = document.querySelector('input[name="pasajeros"]').value;

                // Ocultar mensaje de error
                ocultarError();

                // Validaciones
                if (!origen) {
                    mostrarError("Por favor selecciona un origen");
                    return false;
                }
                if (!destino) {
                    mostrarError("Por favor selecciona un destino");
                    return false;
                }
                if (!fecha) {
                    mostrarError("Por favor selecciona una fecha de salida");
                    return false;
                }
                if (!pasajeros || parseInt(pasajeros) <= 0) {
                    mostrarError("Por favor ingresa el número de pasajeros");
                    return false;
                }

                return true;
            }

            // Función para mostrar error
            function mostrarError(mensaje) {
                errorText.textContent = mensaje;
                errorMessage.style.display = "block";
                errorMessage.style.display = "block";
                errorMessage.scrollIntoView({ behavior: "smooth", block: "center" });
            }

            function ocultarError() {
                errorMessage.style.display = "none";
            }

            // Validar al hacer clic en el botón
            btnBuscar.addEventListener("click", (e) => {
                if (!validarFormulario()) {
                    e.preventDefault();
                }
            });

            // Validar al enviar el formulario
            formulario.addEventListener("submit", (e) => {
                if (!validarFormulario()) {
                    e.preventDefault();
                }
                errorMessage.hidden = true;
            });
            
            selectOrigen.addEventListener('change',(e)=>{
                if(selectOrigen.value===selectDestino.value){
                    selectDestino.selectedIndex = 0;
                }
                document.querySelectorAll('#select-origen option').forEach(option=>{
                    option.disabled=false;
                });
                document.querySelectorAll('#select-destino option').forEach(option=>{
                    option.disabled=false;
                });
                const ciudadSeleccionada=selectOrigen.value;
                console.log(ciudadSeleccionada);
                const optionCiudad=document.getElementById(`${ciudadSeleccionada}-dest`); 
                optionCiudad.disabled=true;
                if(errorText.innerText==="Por favor selecciona un origen"){
                    ocultarError();
                }
            }); 

            selectDestino.addEventListener('change',(e)=>{
                if(selectDestino.value===selectOrigen.value){
                    selectOrigen.selectedIndex = 0;
                }
                document.querySelectorAll('#select-origen option').forEach(option=>{
                    option.disabled=false;
                });
                document.querySelectorAll('#select-destino option').forEach(option=>{
                    option.disabled=false;
                });
                const ciudadSeleccionada=selectDestino.value;
                console.log(ciudadSeleccionada);
                const optionCiudad=document.getElementById(`${ciudadSeleccionada}-org`); 
                optionCiudad.disabled=true;
                if(errorText.innerText==="Por favor selecciona un destino"){
                    ocultarError();
                }
            });

            const tarjetas = document.querySelectorAll(".tarjeta-vuelo");
            tarjetas.forEach(element => {
                element.addEventListener('click',(e)=>{
                    const boton=element.querySelector("button"); 
                    boton.click(); 
                });

            });
            
            document.querySelector('input[name="pasajeros"]').addEventListener('input', function () {
                this.value = this.value
                    .replace(/[^0-9]/g, '') 
                    .replace(/^0+/, '');
                    
                if (this.value === '' || parseInt(this.value) <= 0) {
                    mostrarError("Por favor ingresa un número válido de pasajeros");
                } else {
                    ocultarError();
                }
            });

            document.querySelector('input[name="fecha_salida"]').addEventListener('change', function () {
                const fechaSeleccionada = this.value;


                if (!fechaSeleccionada) {
                    mostrarError("Seleccione una fecha de salida");
                    this.value = '';
                } else {
                    ocultarError();
                }
            });
            
        </script>

        <script>
            const overlayLogin = document.getElementById("overlay");
            const overlayRegistro = document.getElementById("overlay-registro");

            const btnSalirRegistro = document.getElementById("btnSalirRegistro");
            const abrirRegistro = document.querySelector(".pie-login a");
            const abrirLogin = document.getElementById("abrir-login");

            if(abrirRegistro){
                abrirRegistro.addEventListener("click", function(){
                    overlayLogin.hidden = true;
                    overlayRegistro.hidden = false;
                });
            }

            btnSalirRegistro.addEventListener("click", function(){
                overlayRegistro.hidden = true;
            });

            abrirLogin.addEventListener("click", function(){
                overlayRegistro.hidden = true;
                overlayLogin.hidden = false;
            });
    </script>

    <script>
        const formularioRegistro = document.getElementById("formulario-registro");
        const errorRegistro = document.getElementById("error-registro");
        const textoErrorRegistro = document.getElementById("texto-error-registro");

        formularioRegistro.addEventListener("submit", function(e){
            const pass = formularioRegistro.elements["pass"].value.trim();
            const confirmarPass = formularioRegistro.elements["confirmarPass"].value.trim();

            if(pass !== confirmarPass){
                e.preventDefault();
                textoErrorRegistro.textContent = "Las contraseñas no coinciden";
                errorRegistro.hidden = false;
            }
        });
    </script>
</body>
</html>