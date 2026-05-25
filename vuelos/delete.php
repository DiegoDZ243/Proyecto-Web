<?php
    $id_boleto=$_POST["id_boleto"]; 
    require("api/classInfoVuelos.php"); 
    if(!isset($_POST["id_boleto"]) && !isset($_GET["id_boleto"])){
        header("Location: mis_boletos.php"); 
    }

    $classVuelo=new vuelos(); 

    if(isset($_GET["id_boleto"]) && !isset($_POST["id_boleto"])){
        $id_boleto = $_GET["id_boleto"];

        $classVuelo->eliminarBoleto($id_boleto);

        header("Location: mis_boletos.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/delete.css">
</head>
<body>
    <div class="contenedor-eliminar" id="contenedor-eliminar">
        <img src="img/icn-advertencia.png">
        <h3>¿Está seguro de que quiere solicitar un reembolso de este boleto?</h3>
        <div class="cuerpo-eliminar">
            <p>Esta acción no podrá deshacerse. Esta acción eliminará su reserva para este vuelo y su asiento</p>
        </div>
        <div class="eliminar-pie">
            <button id="btnCancelarEliminar">Cancelar</button>
            <button id="btnConfirmarEliminar">Confirmar</button>
        </div>
        <input name="id_boleto" hidden>
    </div>

    <script>
        const btnEliminar=document.getElementById("btnConfirmarEliminar"); 
        const btnCancelar=document.getElementById("btnCancelarEliminar"); 
        const contenedorEliminar=document.getElementById("contenedor-eliminar"); 

        btnCancelar.addEventListener('click',(e)=>{
            window.location.href="mis_boletos.php"; 
        }); 

        btnEliminar.addEventListener('click',(e)=>{
            e.preventDefault();
            window.location.href = "delete.php?id_boleto=<?= $id_boleto ?>";
        }); 

    </script>
</body>
</html>