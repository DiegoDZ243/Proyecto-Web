<?php
    $id_vuelo=1; 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require('api/classVuelo.php'); 
    $vueloActual=new vuelo($id_vuelo); 
    $asientosOcupados=$vueloActual->getAsientosOcupados(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar asientos</title>
    <link rel="stylesheet" href="css/seleccionarAsientos.css">
</head>
<body>
    <section class="contenedor-dividido">
        <section class="contenedor-board-boletos columna">
            <div class="contenedor-board-boletos-encabezado">
                <div class="contenedor-board-titulo">
                    <h3>Resumen de boletos</h3>
                    <img src="#" id="imgBoleto">
                </div>
            </div>
            <div class="contenedor-board-boletos-cuerpo" id="boletosCuerpo">
                <!-- Colocar columnas con numero de asiento al seguido del cargo por elegir el asiento y un icono de persona -->
            </div>
            <div class="contenedor-board-boletos-pie">
                <div class="contenedor-board-total">

                </div>
            </div>
        </section>

        <section class="contenedor-avion columna">
            <div class="contenedor-avion-mitad" id="avion-mitad1">
                
            </div>
            <div class="pasillo">

            </div>
            <div class="contenedor-avion-mitad" id="avion-mitad2">

            </div>
        </section>
    
    </section>
    <form action="llenarBoletos.php" method="post" >
        <input type="text" id="asientoInput" name="asientos" hidden>
        <input type="text" id="idVuelo" name="vuelo" value=<?= $id_vuelo ?> hidden>
        <button id="confirmarAsientos">Continuar</button>
    </form>
        

    <script src="scripts/seleccionarAsientos.js"></script>
    <script>
        const asientosOcupados=<?php echo json_encode($asientosOcupados)?>;
        for(let i=0;i<asientosOcupados.length;i++){
            const asientoCurr=document.getElementById(`asiento-${asientosOcupados[i]}`);
            asientoCurr.classList.add('ocupado'); 
        }
        
    </script>

</body>
</html>