<?php
    require("api/classSalidas.php"); 
    $classSalidas=new vuelos(); 
    $listaSalidas=$classSalidas->getVuelosMas(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de salidas</title>
    <link rel="stylesheet" href="css/salidas.css">
</head>
<body>
    <h1>Lista de salidas (vuelos) disponibles</h1>
    <div class="fondo-salidas">
        <?php foreach($listaSalidas as $v):?>
            <div class="contenedor-unir">
                <div class="contenedor-datos">
                    <div class="item-origen-destino">
                        <div class="item-origen">
                            <img src="<?= $v["img_origen"] ?>">
                            <div class="contendor-origen">
                                <h3>Origen: </h3>
                                <p><?=$v["origen"] ?></p>
                            </div>
                        </div>
                        <div class="item-destino">
                            <img src="<?= $v["img_destino"] ?>">
                            <div class="contendor-destino">
                                <h3>Destino: </h3>
                                <p><?=$v["destino"] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="item-fecha-hora">
                        <div class="item-fecha">
                            <h3>Fecha de salida: </h3>
                            <p><?= $v["fecha"] ?></p>
                        </div>
                        <div class="item-hora">
                            <h3>Hora: </h3>
                            <p><?= $v["hora_salida"] ?></p>
                        </div>
                    </div>
                    <div class="item-precio">
                        <h3>Precio: </h3>
                        <p>$<?= $v["precio"] ?>MXN</p>
                    </div>
                </div>
                <div class="contenedor-botones">
                    <a href="editarSalida.php?id=<?= $v["id_vuelo"] ?>"><img src="img/icn_modificar.png"> Editar Salida</a>
                    <a href="eliminarSalida.php?id=<?= $v["id_vuelo"] ?>"><img src="img/icn_eliminar.png"> Eliminar Salida</a>
                </div>
            </div>
        <?php endforeach?>
        <div class="pie-salidas">
            <a href="crearSalida.php"><img src="img/icn_insertar.png">Crear Salida</a>
        </div>
    </div>
</body>
</html>