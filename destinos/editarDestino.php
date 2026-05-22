<?php
    session_start(); 
    require('api/classDestino.php'); 
    $id_destino=$_GET["id"]; 
    $destinos=new destino(); 

    $destinoActual=$destinos->getDestino($id_destino); 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Destino</title>
    <link rel="stylesheet" href="css/crearDestinos.css">
</head>
<body>
    <form id="formulario-destino" method="post" action="update.php">
        <input name="id_destino" value=<?= $id_destino ?> hidden>
        <div class="contenedor-encabezado">
            <h3>Modificar un destino</h3>
            <p>Modifique los campos para actualizar el destino</p>
        </div>
        <div class="contenedor-error" id="contenedor-error">
            <img src="img/icn-error.png" alt="icono-error" id="imagen-error">
            <h3 id="texto-error"></h3>
        </div>
        <div class="contenedor-inputs">
            <div class="contenedor-nombre">
                <label for="ciudad">Nombre del destino: </label>
                <input type="text" id="input-nombre" name="ciudad" value="<?= $destinoActual["ciudad"] ?>" placeholder="Nombre del destino">
            </div>
            <div class="visualizador-imagen">
                <img src=<?= $destinoActual["imagen"] ?> alt="imagen-destino" id="imagen-destino">
                <div class="contenedor-nombre">
                    <label for="imagen"> Url de la imagen del destino: </label>
                    <input type="text" name="imagen"  id="input-url" value="<?= $destinoActual["imagen"] ?>" placeholder="Pegue la url de la imagen del destino">
                </div>
            </div>
        </div>
        <div class="contenedor-boton">
            <button id="btn-guardar">Guardar</button>
        </div>
    </form>

    <script src="script/crearDestinos.js"></script>
     <script>
        
        <?php if(isset($_SESSION["duplicado"])){ ?>
            destino.value="<?= addslashes($_SESSION["ciudad"]) ?>";
            url.value="<?= addslashes($_SESSION["imagen"]) ?>"; 
            textoError.innerText="El destino especificado ya existe. Elija otro."; 
            contenedorError.style.display="flex"; 
        <?php unset($_SESSION["duplicado"]);unset($_SESSION["ciudad"]);unset($_SESSION["imagen"]);}?>
    </script>
</body>
</html>