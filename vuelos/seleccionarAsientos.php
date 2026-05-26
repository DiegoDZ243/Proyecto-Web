<?php
    session_start(); 
    $id_vuelo=$_POST["vuelo"];
    $pasajeros=$_POST["pasajeros"];

    if(isset($_POST["vuelo"]) && isset($_POST["pasajeros"])){
        $_SESSION["vuelo"]=$id_vuelo; 
        $_SESSION["pasajeros"]=$pasajeros; 
    }

    $id_vuelo=$_SESSION["vuelo"]; 
    $pasajeros=$_SESSION["pasajeros"]; 

    error_reporting(E_ALL);
    ini_set('display_errors', 1);


    require('api/classVuelo.php');

    $vueloActual = new vuelo($id_vuelo);
    $precio=$vueloActual->getPrecio(); 
    $asientosOcupados = $vueloActual->getAsientosOcupados();
    $cupo=$vueloActual->getCupo(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroPHP - Seleccionar Asientos</title>

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/seleccionarAsientos.css">
    <link rel="stylesheet" href="css/barraSuperiorExt.css">
    <link rel="stylesheet" href="css/barraLateralPasajeros.css">
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>
    <section class="barra-superior">
        <div class="contenedor-barra">
            <div class="contenedor-volver-menu">
                <a href="seleccionarVuelo.php">
                    <img src="img/icn-regresar.png">
                    <h3>Regresar</h3>
                </a>
                <div class="contendor-logo">
                    <h5>AeroPHP</h5>
                    <img src="img/icn-logo.png" alt="logo aeropuerto">
                </div>
            </div>
            <div class="contendor-enlaces">
                <?php if(isset($_SESSION["usuario"])):?>
                    <h3> ¡Bienvenido, <?= $_SESSION["usuario"] ?>!</h3>
                <?php endif ?>
                <a href="mis_boletos.php">Mis boletos</a>
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
    <?php if(!isset($_SESSION["usuario"])): ?>
    <div class="fondo-overlay" id="overlay">
        <form id="formulario-login" method="post" action="validar.php">
            <input name="router" value="seleccionarAsientos.php" hidden>
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
                    <input type="email" name="correo" placeholder="Email" id="input-email">
                </div>
                <div class="contenedor-pass-login">
                    <input type="password" name="pass" placeholder="Contraseña" id="input-pass">
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
            <input name="router" value="seleccionarAsientos.php" hidden>

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

                <div class="error-login" id="error-registro" 
                    <?php if(!isset($_GET["errRegistro"])): ?> hidden <?php endif ?>>
                    
                    <p id="texto-error-registro">
                        <?php
                            if(isset($_GET["errRegistro"])){
                                if($_GET["errRegistro"] == "campos"){
                                    echo "Todos los campos son obligatorios";
                                }else if($_GET["errRegistro"] == "pass"){
                                    echo "Las contraseñas no coinciden";
                                }else if($_GET["errRegistro"] == "correo"){
                                    echo "El correo ya está registrado";
                                }else{
                                    echo "Ocurrió un error al registrar";
                                }
                            }else{
                                echo "Todos los campos son obligatorios";
                            }
                        ?>
                    </p>
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

    <?php endif ?>
    <section class="contenedor-dividido">
        <section class="contenedor-board-boletos columna">
            <div class="contenedor-board-boletos-encabezado">
                <div class="contenedor-board-titulo">
                    <div>
                        <h3>Resumen de boletos</h3>
                        <p>Selecciona tus asientos</p>
                    </div>
                    <img src="img/icn-avion.png" id="imgBoleto">
                </div>
            </div>

            <div class="contenedor-board-boletos-cuerpo" id="boletosCuerpo">

            </div>

            <div class="contenedor-board-boletos-pie">
                <div class="contenedor-board-total">
                    <h3>Total</h3>
                    <h2 id="total">$<?= $precio*$pasajeros ?> MXN</h2>
                </div>
                <div class="contenedor-board-asientos">
                    <h3>Asientos:</h3>
                    <h2 id="pasajeros-actuales">0</h2>
                    <h2> / </h2>
                    <h2 id="pasajeros-ticket"><?= $pasajeros ?></h2>
                </div>
            </div>
        </section>

        <section class="contenedor-avion-wrapper">

            <div class="leyenda-avion">

                <div>
                    <span class="demo disponible"></span>
                    Disponible
                </div>

                <div>
                    <span class="demo seleccionado"></span>
                    Seleccionado
                </div>

                <div>
                    <span class="demo ocupado"></span>
                    Ocupado
                </div>

            </div>

            <section class="contenedor-avion columna">

                <div class="contenedor-avion-mitad" id="avion-mitad1">

                </div>

                <div class="pasillo"></div>

                <div class="contenedor-avion-mitad" id="avion-mitad2">

                </div>
            </section>
        </section>
    </section>

    <aside class="barra-lateral-pasajeros">
            <div class="titulo-input-pasajeros">
                <h3>Pasajeros</h3>
                <p>¿Viajan más personas? Aún puede modificar su resvación</p>
            </div>
            <div class="error-pasajeros" id="error-pasajeros" hidden>
                <p id="msg-error-pasajeros" >Seleccione al menos 1 asiento para continuar</p>
            </div>
            <div class="input-pasajeros">
                <div class="input-pasajeros-img">
                    <img src="img/icn-pasajero.png">
                    <input type="number" name="pasajeros" id="pasajeros" value="<?= $pasajeros ?>" step="1" min="1" max="<?= $cupo ?>" placeholder="¿Cuántos viajan?">
                </div>
                <button id="btnLimpiarAsientos">Limpiar selección</button>
            </div>
    </aside>

    <form action="llenarBoletos.php" method="post" id="form-asientos">

        <input
            type="text"
            id="asientoInput"
            name="asientos"
            hidden
        >

        <input
            type="text"
            id="idVuelo"
            name="vuelo"
            value="<?= $id_vuelo ?>"
            hidden
        >

        <div class="contenedor-boton-continuar">
            <button id="confirmarAsientos" type="submit" class="deshabilitado" disabled>
                <div class="interior-boton-continuar">
                    <span>Continuar</span>
                    <span class="contador-asientos"></span hidden>
                </div>
            </button>
        </div>

    </form>

    <script src="scripts/seleccionarAsientos.js"></script>
    <script>
        const botonLogin=document.getElementById("login-boton"); 
        const botonSalirLogin=document.getElementById("btnSalirLogin");
        const fondoOverlay=document.getElementById("overlay"); 
        const formularioLogin=document.getElementById("formulario-login"); 
        const inputEmail=document.getElementById("input-email");
        const inputPass=document.getElementById("input-pass");
        
        formularioLogin.addEventListener("submit",(e)=>{
            if(!inputEmail || !inputPass){
                e.preventDefault(); 
            }
        }); 
        
        <?php if(isset($_GET["err"]) || isset($_GET["registro"])): ?>
            fondoOverlay.hidden=false; 
            formularioLogin.classList.add("sobrepuesta"); 
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
            <?php if(!isset($_SESSION["usuario"])): ?>
                e.preventDefault();
                fondoOverlay.hidden = false;
                window.location.href = "buscarVuelos.php";
            <?php endif ?>
        });


    </script>
    <script>

        const asientosOcupados =
        <?php echo json_encode($asientosOcupados)?>;
        
        const contadorDinamico = document.getElementById('contador-dinamico');

        for(let i=0;i<asientosOcupados.length;i++){

            const asientoCurr =
            document.getElementById(
                `asiento-${asientosOcupados[i]}`
            );

            if(asientoCurr){
                asientoCurr.classList.remove("disponible"); 
                asientoCurr.classList.add('ocupado');
            }

        }

    </script>
    <script>
        const contenedorError=document.getElementById("error-pasajeros"); 
        const mensajeErrorPasajeros=document.getElementById("msg-error-pasajeros"); 
        const pasajerosDisplay=document.getElementById("pasajeros-ticket");

        document.querySelector('input[name="pasajeros"]').addEventListener('input', function () {
            this.value = this.value
                .replace(/[^0-9]/g, '') 
                .replace(/^0+/, '');
                
            if (this.value === '' || parseInt(this.value) <= 0) {
                contenedorError.hidden=false; 
                mensajeErrorPasajeros.innerText="Por favor ingresa un número válido de pasajeros";
            } else if(parseInt(this.value)><?= $cupo ?>) {
                contenedorError.hidden=false;
                mensajeErrorPasajeros.innerText="La reservación excede el número de asientos disponibles";
            }else if(parseInt(this.value)<asientosActuales.length){
                contenedorError.hidden=false;
                mensajeErrorPasajeros.innerText="Tu reservación es menor a la cantidad de asientos seleccionados. Da clic en los asientos que no quieras";
            }else{
                contenedorError.hidden=true;
            }
        });
        
        document.querySelector('input[name="pasajeros"]').addEventListener('change', function () {
           if(parseInt(this.value)>0 && parseInt(this.value)<=<?= $cupo ?> && parseInt(this.value)>=asientosActuales.length){
                pasajerosDisplay.innerText=`${this.value}`
                pasajeros=this.value; 
                let precio=<?= $precio ?>; 
                precio*=pasajeros; 
                document.getElementById("total").innerText=`$${precio} MXN`;
                actualizarEstadoBoton();
            }
        }); 

        document.getElementById("btnLimpiarAsientos").addEventListener('click',(e)=>{
            e.preventDefault(); 
            for(let i=0;asientosActuales.length;i++){
                const temp=asientosActuales.shift();
                quitarAsientoElegido(temp);
                // console.log(temp);
                const asientoAEliminar=document.getElementById(`asiento-${temp}`);
                asientoAEliminar.classList.remove("seleccionado"); 
            }
            cont=0; 
            const pasajerosActualesActualizados=document.getElementById("pasajeros-actuales"); 
            pasajerosActualesActualizados.innerText="0"; 
        }); 

    </script>
           <script>
            const overlayLogin = document.getElementById("overlay");
            const overlayRegistro = document.getElementById("overlay-registro");

            const btnSalirRegistro = document.getElementById("btnSalirRegistro");
            const abrirRegistro = document.querySelector(".pie-login a");
            const abrirLogin = document.getElementById("abrir-login");

            <?php if(isset($_GET["errRegistro"])): ?>
                overlayRegistro.hidden=false; 
            <?php endif ?>

            if(abrirRegistro){
                abrirRegistro.addEventListener("click", function(){
                    overlayLogin.hidden = true;
                    overlayRegistro.hidden = false;
                });
            }

            btnSalirRegistro.addEventListener("click", function(){
                overlayRegistro.hidden = true;
                overlayLogin.hidden=false; 
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