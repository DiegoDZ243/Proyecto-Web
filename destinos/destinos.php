<?php
    require("api/classDestino.php"); 
    $claseDestinos=new destino(); 
    $listaDeDestinos=$claseDestinos->getDestinos(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de destinos</title>
    <link rel="stylesheet" href="css/destinos.css">
</head>
<body>
    <h1>Lista de destinos disponibles</h1>
    <div class="fondo-destinos">   
        
        <div class="contenedor-destino">
            <!-- Izquierda contenedor -->
            <?php foreach($listaDeDestinos as $d): ?>
                <div class="contenedor-unir">
                    <div class="item-destino">
                        <h3>Ciudad: <span><?= $d["ciudad"] ?></span></h3>
                        <img src="<?= $d["imagen"] ?>">
                    </div>
                    <!-- Derecha contenedor -->
                    <div class="contenedor-botones">
                        <a src="img/icn-agregar.jpg" href="editarDestino.php?id=<?= $d["id_destino"] ?>"> <img src="img/icn_modificar.png"> Editar Destino </a>
                        <a src="img/icn-editar.jpg" href="eliminarDestino.php?id=<?= $d["id_destino"] ?>"> <img src="img/icn_eliminar.png"> Eliminar Destino </a>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="pie-destino">
                <button><a href="crearDestinos.php">Crear Destino</a></button>
            </div>
        </div>

    </div>
</body>
</html>