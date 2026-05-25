<?php
    session_start(); 
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
    <link rel="stylesheet" href="css/barraSuperiorExt.css">
    <link rel="stylesheet" href="css/barraLateralIzquierda.css">
</head>
<body>
    <div class="navbar">
        <div>
            <a href="../dashboard_empleado.php"><img src="img/icn-regresar.png"> Regresar</a>
            <h1>🛫 AeroPHP - Panel de Empleado</h1>
        </div>
        <div class="usuario-info">
            <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></p>
            <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>
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
                <button id="btnCrear"><a href="crearDestinos.php"><img src="img/icn_insertar.png"> Crear Destino</a></button>
                <button><a href="../dashboard_empleado.php">← Volver al Dashboard</a></button>
            </div>
        </div>

    </div>
    <aside class="barra-inferior-izquierda">
        <a href="#btnCrear"><img src="img/icn-flecha-abajo.png"></a>
    </aside>
</body>
</html>