<?php
session_start();

// Verificar que sea empleado
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'empleado') {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AeroPHP Empleados</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }
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
            font-size: 1.8em;
        }
        .usuario-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .usuario-info p {
            font-size: 0.95em;
        }
        .logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }
        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
        }
        .contenedor {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .titulo {
            text-align: center;
            margin-bottom: 40px;
        }
        .titulo h2 {
            color: #333;
            font-size: 2em;
            margin-bottom: 10px;
        }
        .titulo p {
            color: #666;
            font-size: 1.1em;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .card h3 {
            color: #333;
            font-size: 1.5em;
            margin-bottom: 15px;
        }
        .card p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 0.95em;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }
        .btn-secondary:hover {
            background: #d0d0d0;
        }
        .btn-success {
            background: #28a745;
            color: white;
        }
        .btn-success:hover {
            background: #218838;
        }
        .btn-info {
            background: #17a2b8;
            color: white;
        }
        .btn-info:hover {
            background: #138496;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .icon {
            font-size: 3em;
            margin-bottom: 15px;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🛫 AeroPHP - Panel de Empleado</h1>
        <div class="usuario-info">
            <p>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></p>
            <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>

    <div class="contenedor">
        <div class="titulo">
            <h2>Gestión Administrativa</h2>
            <p>Accede a los módulos de gestión de destinos y salidas</p>
        </div>

        <div class="grid">
            <!-- TARJETA: DESTINOS -->
            <div class="card">
                <div class="icon">📍</div>
                <h3>Gestión de Destinos</h3>
                <p>Crea, edita y elimina destinos disponibles en el sistema.</p>
                <div class="button-group">
                    <a href="destinos/destinos.php" class="btn btn-primary">Ver Destinos</a>
                    <a href="destinos/crearDestinos.php" class="btn btn-success">Crear Destino</a>
                </div>
            </div>

            <!-- TARJETA: SALIDAS -->
            <div class="card">
                <div class="icon">✈️</div>
                <h3>Gestión de Salidas</h3>
                <p>Crea, edita y elimina salidas (vuelos) del sistema.</p>
                <div class="button-group">
                    <a href="salidas/salidas.php" class="btn btn-primary">Ver Salidas</a>
                    <a href="salidas/crearSalida.php" class="btn btn-success">Crear Salida</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
