<?php
session_start();

if(!isset($_SESSION["usuario"])){
    header("Location: buscarVuelos.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("api/classInfoVuelos.php");
require_once("api/classVuelo.php");

$infoBoletos = new vuelos();

$id_boleto = intval($_GET["id_boleto"] ?? $_POST["id_boleto"] ?? 0);

if($id_boleto <= 0){
    header("Location: mis_boletos.php");
    exit();
}

$boletoActual = $infoBoletos->getBoletoById($id_boleto);

$id_vuelo = $boletoActual["id_vuelo"];
$asientoActual = $boletoActual["asiento"];

$vueloActual = new vuelo($id_vuelo);
$infoVuelo = $vueloActual->getInfo();
$asientosOcupados = $vueloActual->getAsientosOcupados();

/*
    Quitamos el asiento actual de la lista de ocupados,
    para que el usuario pueda dejarlo seleccionado.
*/
$asientosOcupados = array_filter($asientosOcupados, function($asiento) use ($asientoActual){
    return $asiento != $asientoActual;
});
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Boleto</title>

    <link rel="stylesheet" href="css/seleccionarAsientos.css">
    <link rel="stylesheet" href="css/llenarBoletos.css">
    <link rel="stylesheet" href="css/barraSuperiorExt.css">
</head>
<body>

<section class="barra-superior">
    <div class="contenedor-barra">
        <div class="contenedor-volver-menu">
            <a href="mis_boletos.php">
                <img src="img/icn-regresar.png">
                <h3>Regresar</h3>
            </a>

            <div class="contendor-logo">
                <h5>AeroPHP</h5>
                <img src="img/icn-logo.png" alt="logo aeropuerto">
            </div>
        </div>

        <div class="contendor-enlaces">
            <h3>¡Bienvenido, <?= htmlspecialchars($_SESSION["usuario"]) ?>!</h3>
            <a href="mis_boletos.php">Mis boletos</a>
            <a href="../logout.php" style="color: red;">
                <img src="img/icn-usuario.png" alt="iconoUsuario">
                <h5>Cerrar sesión</h5>
            </a>
        </div>
    </div>
</section>

<main class="contenedor-llenar-boletos">
    <div class="encabezado-seccion">
        <h1>Editar boleto</h1>
        <p>Modifica el asiento y los datos del pasajero</p>
    </div>

    <form action="guardarEdicionBoleto.php" method="POST" id="form-editar-boleto" class="formulario-boletos">

        <input type="hidden" name="id_boleto" value="<?= htmlspecialchars($id_boleto) ?>">
        <input type="hidden" name="id_vuelo" value="<?= htmlspecialchars($id_vuelo) ?>">
        <input type="hidden" name="asiento" id="asientoInput" value="<?= htmlspecialchars($asientoActual) ?>">

        <section class="cuerpo-llenar-boletos">
            <div class="contenedor-llenado">

                <div class="formulario-cliente">
                    <div class="encabezado-formulario">
                        <div class="badge-asiento">
                            Asiento seleccionado:
                            <strong id="asientoSeleccionadoTexto"><?= htmlspecialchars($asientoActual) ?></strong>
                        </div>
                    </div>

                    <div class="error-message" id="error-boleto" style="display:none;">
                        <span class="error-icon">⚠️</span>
                        <p id="error-text-boleto"></p>
                    </div>

                    <div class="contenedor-input">
                        <label>Nombre <span class="asterisco">*</span></label>
                        <input 
                            type="text" 
                            name="nombre" 
                            id="nombre"
                            class="input-field"
                            value="<?= htmlspecialchars($boletoActual["nombre"]) ?>"
                            placeholder="Ingresa tu nombre"
                        >
                    </div>

                    <div class="contenedor-input">
                        <label>Apellido Paterno <span class="asterisco">*</span></label>
                        <input 
                            type="text" 
                            name="a_paterno" 
                            id="a_paterno"
                            class="input-field"
                            value="<?= htmlspecialchars($boletoActual["a_paterno"]) ?>"
                            placeholder="Ingresa tu apellido paterno"
                        >
                    </div>

                    <div class="contenedor-input">
                        <label>Apellido Materno <span class="asterisco">*</span></label>
                        <input 
                            type="text" 
                            name="a_materno" 
                            id="a_materno"
                            class="input-field"
                            value="<?= htmlspecialchars($boletoActual["a_materno"]) ?>"
                            placeholder="Ingresa tu apellido materno"
                        >
                    </div>
                </div>

                <div class="boleto">
                    <div class="encabezado-boleto">
                        <div class="contenedor-encabezado">
                            <h4 class="pase-abordaje">Pase de Abordaje</h4>
                            <img src="img/icn-avion.png" alt="avion">
                        </div>

                        <div class="contenedor-nombre-aerolinea">
                            <h3 class="nombre-aerolinea">AeroPHP</h3>
                            <img src="img/icn-logo.png" alt="logo">
                        </div>
                    </div>

                    <div class="cuerpo-boleto">
                        <section class="contenedor-nombre">
                            <h3>Pasajero:</h3>
                            <h4 id="txt_nombre">-</h4>
                        </section>

                        <section class="contenedor-codigo-barras">
                            <div class="barcode-placeholder">
                                <img src="img/icn-vuelo.png" alt="barcode" style="width: 60px; opacity: 0.3;">
                            </div>
                        </section>
                    </div>

                    <div class="pie-boleto">
                        <div class="contenedor-origen-destino">
                            <div class="contenedor-origen">
                                <h3>Origen:</h3>
                                <h5><?= htmlspecialchars($infoVuelo["origen"]) ?></h5>
                            </div>

                            <div class="contenedor-destino">
                                <h3>Destino:</h3>
                                <h5><?= htmlspecialchars($infoVuelo["destino"]) ?></h5>
                            </div>
                        </div>

                        <div class="contenedor-fecha-y-hora">
                            <div class="contenedor-fecha">
                                <h3>Fecha:</h3>
                                <h5><?= htmlspecialchars($infoVuelo["fecha"]) ?></h5>
                            </div>

                            <div class="contenedor-hora">
                                <h3>Hora:</h3>
                                <h5><?= htmlspecialchars($infoVuelo["hora"]) ?></h5>
                            </div>
                        </div>

                        <div class="contenedor-asiento">
                            <h3>Asiento: <strong id="txt_asiento"><?= htmlspecialchars($asientoActual) ?></strong></h3>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="contenedor-avion-wrapper">
            <div class="leyenda-avion">
                <div><span class="demo disponible"></span> Disponible</div>
                <div><span class="demo seleccionado"></span> Seleccionado</div>
                <div><span class="demo ocupado"></span> Ocupado</div>
            </div>

            <section class="contenedor-avion columna">
                <div class="contenedor-avion-mitad" id="avion-mitad1"></div>
                <div class="pasillo"></div>
                <div class="contenedor-avion-mitad" id="avion-mitad2"></div>
            </section>
        </section>

        <div class="contenedor-boton-guardar">
            <button type="submit" class="btn-guardar-boletos">
                <span>Guardar cambios</span>
                <span class="icono-boton">→</span>
            </button>
        </div>

    </form>
</main>

<script>
const asientosOcupados = <?= json_encode(array_values($asientosOcupados)) ?>;
let asientoActual = "<?= htmlspecialchars($asientoActual) ?>";

const contenedorMitadIzquierdaAvion = document.getElementById("avion-mitad1");
const contenedorMitadDerechaAvion = document.getElementById("avion-mitad2");

const inputAsiento = document.getElementById("asientoInput");
const asientoSeleccionadoTexto = document.getElementById("asientoSeleccionadoTexto");
const txtAsiento = document.getElementById("txt_asiento");

const nombre = document.getElementById("nombre");
const aPaterno = document.getElementById("a_paterno");
const aMaterno = document.getElementById("a_materno");
const txtNombre = document.getElementById("txt_nombre");

const formulario = document.getElementById("form-editar-boleto");
const errorBoleto = document.getElementById("error-boleto");
const errorTexto = document.getElementById("error-text-boleto");

function generarAsientos(){
    const letrasIzquierda = ["A", "B", "C"];
    const letrasDerecha = ["D", "E", "F"];

    for(let i = 1; i <= 8; i++){
        const filaActual = document.createElement("div");
        filaActual.className = "fila-asientos";

        letrasIzquierda.forEach(letra => {
            const asiento = crearAsiento(letra + i);
            filaActual.appendChild(asiento);
        });

        contenedorMitadIzquierdaAvion.appendChild(filaActual);
    }

    for(let i = 1; i <= 8; i++){
        const filaActual = document.createElement("div");
        filaActual.className = "fila-asientos";

        letrasDerecha.forEach(letra => {
            const asiento = crearAsiento(letra + i);
            filaActual.appendChild(asiento);
        });

        contenedorMitadDerechaAvion.appendChild(filaActual);
    }
}

function crearAsiento(numero){
    const asiento = document.createElement("div");

    asiento.innerText = numero;
    asiento.className = "asiento disponible";
    asiento.id = `asiento-${numero}`;

    if(asientosOcupados.includes(numero)){
        asiento.classList.remove("disponible");
        asiento.classList.add("ocupado");
    }

    if(numero === asientoActual){
        asiento.classList.add("seleccionado");
    }

    asiento.addEventListener("click", function(){
        if(asiento.classList.contains("ocupado")){
            return;
        }

        const asientoAnterior = document.getElementById(`asiento-${asientoActual}`);

        if(asientoAnterior){
            asientoAnterior.classList.remove("seleccionado");
        }

        asientoActual = numero;
        asiento.classList.add("seleccionado");

        inputAsiento.value = numero;
        asientoSeleccionadoTexto.innerText = numero;
        txtAsiento.innerText = numero;
    });

    return asiento;
}

function actualizarNombreBoleto(){
    const nombreCompleto = `${nombre.value.trim()} ${aPaterno.value.trim()} ${aMaterno.value.trim()}`.trim();
    txtNombre.innerText = nombreCompleto === "" ? "-" : nombreCompleto;
}

nombre.addEventListener("input", actualizarNombreBoleto);
aPaterno.addEventListener("input", actualizarNombreBoleto);
aMaterno.addEventListener("input", actualizarNombreBoleto);

formulario.addEventListener("submit", function(e){
    if(inputAsiento.value.trim() === ""){
        e.preventDefault();
        errorBoleto.style.display = "flex";
        errorTexto.innerText = "Selecciona un asiento";
        return;
    }

    if(nombre.value.trim() === ""){
        e.preventDefault();
        errorBoleto.style.display = "flex";
        errorTexto.innerText = "Por favor completa el nombre";
        nombre.focus();
        return;
    }

    if(aPaterno.value.trim() === ""){
        e.preventDefault();
        errorBoleto.style.display = "flex";
        errorTexto.innerText = "Por favor completa el apellido paterno";
        aPaterno.focus();
        return;
    }

    if(aMaterno.value.trim() === ""){
        e.preventDefault();
        errorBoleto.style.display = "flex";
        errorTexto.innerText = "Por favor completa el apellido materno";
        aMaterno.focus();
        return;
    }

    errorBoleto.style.display = "none";
});

generarAsientos();
actualizarNombreBoleto();
</script>

</body>
</html>