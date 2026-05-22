<?php
    require("api/classDestino.php"); 
    echo "Hola"; 
    $claseDestinos=new destino(); 
    $listaDeDestinos=$claseDestinos->getDestinos(); 
    foreach($listaDeDestinos as $d){
        echo $d["ciudad"]."<br>";
        echo $d["id_destino"]."<br>"; 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de destinos</title>
</head>
<body>
    <div class="fondo-destinos">   
        
        <div class="contenedor-destino">
            <!-- Izquierda contenedor -->
            <?php foreach($listaDeDestinos as $d): ?>
                <div class="contenedor-unir">
                    <div class="item.destino">
                        <h3>Ciudad: <span><?= $d["ciudad"] ?></span></h3>
                        <img src="<?= $d["imagen"] ?>">
                    </div>
                    <!-- Derecha contenedor -->
                    <div class="contenedor-botones">
                        <button src="img/icn-agregar.jpg" href="editarDestino.php?id=<?= $d["id_destino"] ?>"> <img src="img/icn_modificar.png"> Editar Destino </button>
                        <button src="img/icn-editar.jpg" href="eliminarDestino.php?id=<?= $d["id_destino"] ?>"> <img src="img/icn_eliminar.png"> Eliminar Destino </button>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="pie-destino">
                <button><a href="crearDestinos.html">Crear Destino</a></button>
            </div>
        </div>

    </div>
</body>
</html>