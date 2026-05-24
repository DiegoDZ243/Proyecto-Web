<?php
    session_start();
    
    $origen=$_POST["origen"]; 
    $destino=$_POST["destino"]; 
    $fecha_salida=$_POST["fecha_salida"]; 
    $pasajeros=$_POST["pasajeros"]; 
    
    if(isset($_POST["origen"]) && isset($_POST["destino"]) && isset($_POST['fecha_salida']) && isset($_POST['pasajeros'] )){
        $_SESSION['origen'] = $origen;
        $_SESSION['destino'] = $destino;
        $_SESSION['fecha_salida'] = $fecha_salida;
        $_SESSION['pasajeros'] = $pasajeros;
    }

    $origen=$_SESSION["origen"]; 
    $destino=$_SESSION["destino"]; 
    $fecha_salida=$_SESSION["fecha_salida"]; 
    $pasajeros=$_SESSION["pasajeros"]; 

    require("api/classInfoVuelos.php"); 
    $vuelos=new vuelos();
    $vuelosFiltrados=$vuelos->getVuelosFiltrado($origen,$destino,$fecha_salida,$pasajeros); 

    if (empty($vuelosFiltrados)) {
        header("Location: noHayResultados.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroPHP - Vuelos</title>
    <link rel="stylesheet" href="css/seleccionarVuelo.css">
    <link rel="stylesheet" href="css/barraSuperiorExt.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <section class="barra-superior">
        <div class="contenedor-barra">
            <div class="contenedor-volver-menu">
                <a href="buscarVuelos.php">
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
    <div class="fondo-overlay" id="overlay" hidden>
        <form id="formulario-login" method="post" action="validar.php">
            <input name="router" value="seleccionarVuelo.php" hidden>
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
    <main>
        <section class="resultado-busqueda">
            <div>
                <h1>Resultado de la búsqueda</h1>
                <img src="img/icn-buscar.png">
            </div>
            <section class="encabezado-busqueda">
                <h5>Elige tu vuelo de:  <p><?= $vuelosFiltrados[0]["origen"] ?> a <?= $vuelosFiltrados[0]["destino"] ?></p></h5>
            </section>
            <section class="cuerpo-busqueda">
                <?php foreach($vuelosFiltrados as $v): ?>
                <form class="tarjeta-resultado" method="post" action="seleccionarAsientos.php">
                    <input name="vuelo" value="<?= $v["id_vuelo"] ?>" hidden>
                    <input name="pasajeros" value="<?= $pasajeros ?>" hidden>
                    <div class="contenedor-origen-destino">
                        
                        <div class="origen-a-destino">
                            <div class="info-origen">
                                <h3><?= $v["hora"] ?></h3>
                                <h5><?= $v["origen"] ?></h5>
                            </div>
                            <img src="img/icn-vuelo.png" alt="icono de vuelo">
                            <div class="info-destino">
                                <h5><?= $v["destino"] ?></h5>
                            </div>
                        </div>
                    </div>
                    
                    <button class="info-precio">
                        <div class="display-precio">
                            <h3>$<?= $v["precio"] ?> <p>MXN</p></h3>
                            <h4 class="elegir-vuelo"> > </h4>
                        </div>
                    </button>   
                </form>
                <?php endforeach ?>
            </section>
        </section>
        <aside class="barra-lateral-izquierda">
                <div class="tarjeta-reservacion">
                    <div class="titulo-reservacion">
                        <h3>Tu reservación</h3>
                    </div>
                    <div class="cuerpo-reservacion">
                        <h3>Pasajeros</h3>
                        <p><?= $pasajeros ?></p>
                    </div>
                </div>
        </aside>
    </main>



    <script>
            const botonLogin=document.getElementById("login-boton"); 
            const botonSalirLogin=document.getElementById("btnSalirLogin");
            const fondoOverlay=document.getElementById("overlay"); 
            const formularioLogin=document.getElementById("formulario-login"); 
            
            

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
                    }else{
                        fondoOverlay.hidden=false;
                    }    
                <?php endif ?>
            }); 


        </script>
</body>
</html>