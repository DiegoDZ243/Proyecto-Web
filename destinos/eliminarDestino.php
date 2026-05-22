<?php
session_start();

// Verificar que sea empleado
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'empleado') {
    header('Location: ../index.html');
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : (isset($_POST['id_destino']) ? intval($_POST['id_destino']) : null);

// Si viene por POST, eliminar el destino
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
    require_once('../Conexion/classConnectionMySQL.php');
    
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $sql = "CALL sp_eliminarDestino($id)";
    $conn->ExecuteQuery($sql);
    $conn->ClearResults();
    $conn->CloseConnection();
    
    header('Location: destinos.php');
    exit();
}

// Si no hay id o viene por GET, mostrar confirmación
if (!$id) {
    header('Location: destinos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar eliminación - Destino</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .modal {
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }
        .modal h2 {
            color: #d9534f;
            font-size: 1.8em;
            margin-bottom: 15px;
        }
        .modal p {
            color: #666;
            font-size: 1.05em;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .warning-icon {
            font-size: 3em;
            color: #d9534f;
            margin-bottom: 20px;
        }
        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-danger {
            background: #d9534f;
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(217, 83, 79, 0.4);
        }
        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }
        .btn-secondary:hover {
            background: #d0d0d0;
            transform: translateY(-2px);
        }
        .info-text {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.95em;
            color: #555;
            border-left: 4px solid #d9534f;
        }
    </style>
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
