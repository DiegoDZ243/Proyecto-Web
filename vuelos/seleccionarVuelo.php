<?php
    session_start();
    
    $origen = $_POST["origen"] ?? ''; 
    $destino = $_POST["destino"] ?? ''; 
    $fecha_salida = $_POST["fecha_salida"] ?? ''; 
    $pasajeros = $_POST["pasajeros"] ?? ''; 
    
    
    if (empty($origen)) {
        $errores[] = "Origen es requerido";
    }
    if (empty($destino)) {
        $errores[] = "Destino es requerido";
    }
    if (empty($fecha_salida)) {
        $errores[] = "Fecha de salida es requerida";
    }
    if (empty($pasajeros) || intval($pasajeros) <= 0) {
        $errores[] = "Número de pasajeros válido es requerido";
    }
    
    require("api/classInfoVuelos.php"); 
    $vuelos=new vuelos();
    $vuelosFiltrados=$vuelos->getVuelosFiltrado($origen,$destino,$fecha_salida,$pasajeros); 

    // Verificar si no hay resultados
    if (empty($vuelosFiltrados)) {
        $_SESSION['origen'] = $origen;
        $_SESSION['destino'] = $destino;
        $_SESSION['fecha_salida'] = $fecha_salida;
        $_SESSION['pasajeros'] = $pasajeros;
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
</head>
<body>

    <main>
        <section class="resultado-busqueda">
            <section class="encabezado-busqueda">
                <h5>Elige tu vuelo de <p><?= $vuelosFiltrados[0]["origen"] ?> a <?= $vuelosFiltrados[0]["destino"] ?></p></h5>
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
    </main>
</body>
</html>