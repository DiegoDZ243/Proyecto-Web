<?php
session_start();

require_once('../Conexion/classConnectionMySQL.php');

$id_usuario = $_SESSION['usuario_id'];

$conn = new ConnectionMySQL();
$conn->CreateConnection();

// Obtener boletos del usuario
$query = "SELECT 
            b.id_boleto,
            b.asiento,
            b.nombre,
            b.a_paterno,
            b.a_materno,
            b.checked_in,
            v.id_vuelo,
            v.fecha,
            v.hora_salida,
            v.precio,
            o.ciudad as origen,
            d.ciudad as destino
        FROM boletos b
        JOIN vuelos v ON b.id_vuelo = v.id_vuelo
        JOIN destinos o ON v.id_origen = o.id_destino
        JOIN destinos d ON v.id_destino = d.id_destino
        WHERE b.id_usuario = $id_usuario
        ORDER BY v.fecha DESC";

$result = $conn->ExecuteQuery($query);
$boletos = [];

if ($result && $result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $boletos[] = $fila;
    }
    $result->free();
}

$conn->CloseConnection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Boletos - AeroPHP</title>
    <link rel="stylesheet" href="css/buscarVuelos.css">
    <style>
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar h1 {
            font-size: 1.5em;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            transition: all 0.3s;
        }
        .navbar a:hover {
            opacity: 0.8;
        }
        .contenedor {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .titulo {
            text-align: center;
            margin-bottom: 30px;
        }
        .titulo h2 {
            color: #333;
            font-size: 2em;
            margin-bottom: 10px;
        }
        .boletos-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }
        .boleto-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
            transition: transform 0.3s;
        }
        .boleto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .boleto-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .boleto-header h3 {
            font-size: 1.3em;
            color: #333;
        }
        .estado-boleto {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85em;
            font-weight: 600;
        }
        .estado-confirmado {
            background: #d4edda;
            color: #155724;
        }
        .estado-pendiente {
            background: #fff3cd;
            color: #856404;
        }
        .boleto-info {
            margin-bottom: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .boleto-info label {
            font-weight: 600;
            color: #667eea;
            display: block;
            font-size: 0.9em;
            margin-bottom: 4px;
        }
        .boleto-info p {
            color: #333;
            margin: 0;
        }
        .pasajero-info {
            background: #f9f9f9;
            padding: 12px;
            border-radius: 5px;
            margin: 12px 0;
        }
        .pasajero-info h4 {
            margin: 0 0 8px 0;
            color: #333;
        }
        .no-boletos {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            color: #666;
        }
        .no-boletos p {
            font-size: 1.1em;
            margin-bottom: 20px;
        }
        .btn-volver {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-volver:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🛫 Mis Boletos</h1>
        <div>
            <a href="buscarVuelos.php">← Volver a Búsqueda</a>
            <a href="../logout.php">Cerrar Sesión</a>
        </div>
    </div>

    <div class="contenedor">
        <div class="titulo">
            <h2>Tus Boletos de Vuelo</h2>
            <p>Aquí puedes ver todos tus boletos de vuelo reservados</p>
        </div>

        <?php if (empty($boletos)): ?>
            <div class="no-boletos">
                <p>No tienes boletos reservados aún.</p>
                <a href="buscarVuelos.php" class="btn-volver">Buscar y Reservar Vuelos</a>
            </div>
        <?php else: ?>
            <div class="boletos-list">
                <?php foreach ($boletos as $boleto): ?>
                    <div class="boleto-card">
                        <div class="boleto-header">
                            <h3><?= htmlspecialchars($boleto['origen']) ?> → <?= htmlspecialchars($boleto['destino']) ?></h3>
                            <span class="estado-boleto <?= $boleto['checked_in'] ? 'estado-confirmado' : 'estado-pendiente' ?>">
                                <?= $boleto['checked_in'] ? 'Check-in Realizado' : 'Pendiente Check-in' ?>
                            </span>
                        </div>

                        <div class="boleto-info">
                            <label>Fecha de Vuelo</label>
                            <p><?= date('d/m/Y', strtotime($boleto['fecha'])) ?></p>
                        </div>

                        <div class="boleto-info">
                            <label>Hora de Salida</label>
                            <p><?= $boleto['hora_salida'] ?></p>
                        </div>

                        <div class="boleto-info">
                            <label>Asiento</label>
                            <p style="font-size: 1.3em; font-weight: bold; color: #667eea;"><?= htmlspecialchars($boleto['asiento']) ?></p>
                        </div>

                        <div class="pasajero-info">
                            <h4>Pasajero</h4>
                            <p><?= htmlspecialchars($boleto['nombre'] . ' ' . $boleto['a_paterno'] . ' ' . $boleto['a_materno']) ?></p>
                        </div>

                        <div class="boleto-info">
                            <label>Precio</label>
                            <p style="font-size: 1.2em; color: #28a745;">$<?= number_format($boleto['precio'], 2) ?> MXN</p>
                        </div>

                        <div class="boleto-info">
                            <label>ID Boleto</label>
                            <p style="font-size: 0.9em; color: #999;">#<?= $boleto['id_boleto'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
