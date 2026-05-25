<?php
session_start();

$id = $_GET["id"]; 

// Si viene por POST, eliminar el destino

require_once('../Conexion/classConnectionMySQL.php');

if(isset($_POST["id_destino"])){
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $sql = "CALL sp_eliminarDestino($id)";
    $conn->ExecuteQuery($sql);
    $conn->ClearResults();
    $conn->CloseConnection();
    header("Location: destinos.php"); 
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar eliminación - Destino</title>
    <link rel="stylesheet" href="css/eliminarDestino.css">
</head>
<body>
    <div class="modal">
        <div class="warning-icon">⚠️</div>
        <h2>¿Estás seguro?</h2>
        <p>Vas a eliminar este destino del sistema. Esta acción no se podrá deshacer.</p>
        
        <div class="info-text">
            Se eliminarán también todos los vuelos asociados a este destino y sus boletos correspondientes.
        </div>

        <form method="post" style="display: inline;">
            <input type="hidden" name="id_destino" value="<?= $id ?>">
            <div class="actions">
                <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                <a href="destinos.php" class="btn btn-secondary">No, cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
