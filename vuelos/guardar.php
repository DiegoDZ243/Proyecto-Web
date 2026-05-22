<?php
    $boletos = $_POST['boletos'];
    require("api/classVuelo.php"); 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $vueloActual=new vuelo($boletos[0]["vuelo"]);
    foreach($boletos as $b){
        $vueloActual->registrarBoleto($b,1); 
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Confirmada</title>
    <link rel="stylesheet" href="css/guardar.css">
</head>
<body>

    <section class="contenedor-confirmacion">

        <div class="encabezado">
            <h1>✅ Compra Confirmada</h1>
            <p>Tus boletos han sido registrados correctamente.</p>
        </div>

        <div class="lista-boletos">

            <?php foreach ($boletos as $index => $b): ?>

                <div class="boleto">

                    <h3>Boleto <?= $index + 1 ?></h3>

                    <div class="info">

                        <div class="campo">
                            <span>Asiento</span>
                            <p><?= $b['asiento'] ?></p>
                        </div>

                        <div class="campo">
                            <span>Nombre Completo</span>
                            <p>
                                <?= $b['nombre'] ?>
                                <?= $b['a_paterno'] ?>
                                <?= $b['a_materno'] ?>
                            </p>
                        </div>

                        <div class="campo">
                            <span>Vuelo</span>
                            <p><?= $b['vuelo'] ?></p>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <div class="contenedor-boton">
            <a href="buscarVuelos.php" class="btn-regresar">
                Buscar más vuelos
            </a>
        </div>

    </section>

</body>
</html>