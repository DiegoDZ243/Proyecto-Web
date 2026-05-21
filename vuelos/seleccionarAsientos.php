<!-- seleccionarAsientos.php -->
<?php
    $id_vuelo=$_POST["vuelo"];
    $pasajeros=$_POST["pasajeros"];

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require('api/classVuelo.php');

    $vueloActual = new vuelo($id_vuelo);
    $asientosOcupados = $vueloActual->getAsientosOcupados();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AeroPHP - Seleccionar Asientos</title>

    <link rel="stylesheet" href="css/seleccionarAsientos.css">
</head>

<body>

    <section class="contenedor-dividido">

        <!-- BOARD -->
        <section class="contenedor-board-boletos columna">

            <div class="contenedor-board-boletos-encabezado">

                <div class="contenedor-board-titulo">
                    <div>
                        <h3>Resumen de boletos</h3>
                        <p>Selecciona tus asientos</p>
                    </div>

                    <img src="img/icn-boleto.png" id="imgBoleto">
                </div>

            </div>

            <div class="contenedor-board-boletos-cuerpo" id="boletosCuerpo">
                <!-- JS -->
            </div>

            <div class="contenedor-board-boletos-pie">

                <div class="contenedor-board-total">
                    <h3>Total</h3>
                    <h2 id="total">$0 MXN</h2>
                </div>

            </div>

        </section>

        <!-- INPUT HIDDEN -->
        <input id="pasajeros" type="number" value="<?= $pasajeros ?>" hidden>

        <!-- AVIÓN -->
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

    <!-- FORM -->
    <form action="llenarBoletos.php" method="post">

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

        <button id="confirmarAsientos">
            Continuar
        </button>

    </form>

    <script src="scripts/seleccionarAsientos.js"></script>

    <script>

        const asientosOcupados =
        <?php echo json_encode($asientosOcupados)?>;

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

</body>
</html>